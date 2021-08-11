<?php


namespace Source\App;


use Source\Core\Controlador;
use Source\Models\Apartamento;
use Source\Models\Autenticacao;
use Source\Models\Encomenda;
use Source\Models\Morador;
use Source\Models\Usuario;

class Moradores extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VISAO_SISTEMA . "/");

        if (!$this->usuario = Autenticacao::usuario()) {
            $this->mensagem->aviso("Efetue login para acessar o APP.")->flash();
            redirect("/");
        }
    }

    public function moradores(): void
    {
        $moradores = new Morador();
        if (Autenticacao::usuario()->tipo == "MORADOR") {
            $moradores = $moradores->buscaPorUsuario(Autenticacao::usuario()->id);
        } else {
            $moradores = $moradores->buscar()->fetchall();
        }
        echo $this->visao->render("listas/moradores", [
            "moradores" => $moradores
        ]);
    }

    public function morador(?array $dados): void
    {
        if (Autenticacao::usuario()->tipo != "MORADOR") {
            $this->mensagem->aviso("Apenas usuário do tipo MORADOR pode realizar cadastro de novo moradores")->flash();
            redirect("/moradores");
        }

        $apartamento = (new Apartamento())->buscarPorUsuario(Autenticacao::usuario()->id);
        if (!empty($dados["acao"]) && $dados["acao"] == "criar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $novoMorador = new Morador();
            $novoMorador->nome = $dados["nome"];
            $novoMorador->sobrenome = $dados["sobrenome"];
            $novoMorador->documento = $dados["documento"];
            $novoMorador->nascimento = data_fmt_back($dados["nascimento"]);
            $novoMorador->email = $dados["email"];
            $novoMorador->telefone = $dados["telefone"];
            $novoMorador->usuario_id = Autenticacao::usuario()->id;
            if ($apartamento) {
                $novoMorador->apartamento_id = intval($apartamento->id);
            }
            if (!$dados["data_entrada"]) {
               $novoMorador->data_entrada = date('Y-m-d');
            } else {
               $novoMorador->data_entrada = data_fmt_back($dados["data_entrada"]);
            }

            if (!$novoMorador->salvar()) {
                var_dump($dados);
                $json['mensagem'] = $novoMorador->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Morador cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/morador/{$novoMorador->id}");
            echo json_encode($json);
            return;
        }
        if (!empty($dados["acao"]) && $dados['acao'] == "atualizar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $moradorAtualizar = (new Morador())->buscarPorId($dados["id"]);

            if (!$moradorAtualizar) {
                $this->mensagem->erro("Este morador não existe")->flash();
                echo json_encode(["redirect" => url("/moradores")]);
                return;
            }

            $moradorAtualizar->nome = $dados["nome"];
            $moradorAtualizar->sobrenome = $dados["sobrenome"];
            $moradorAtualizar->documento = $dados["documento"];
            $moradorAtualizar->nascimento = data_fmt_back($dados["nascimento"]);
            $moradorAtualizar->email = $dados["email"];
            $moradorAtualizar->telefone = $dados["telefone"];
            if ($apartamento) {
                $moradorAtualizar->apartamento_id = intval($apartamento->id);
            }
            $moradorAtualizar->data_entrada = data_fmt_back($dados["data_entrada"]);
            $moradorAtualizar->data_saida = data_fmt_back($dados["data_saida"]);
            $moradorAtualizar->usuario_id = Autenticacao::usuario()->id;

            if (!$moradorAtualizar->salvar()) {
                var_dump($dados);
                $json["mensagem"] = $moradorAtualizar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Morador atualizado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        $morador = null;
        if (!empty($dados["id"])) {
            $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
            $morador = (new Morador())->buscarPorId($id);
        }
        echo $this->visao->render("cadastros/morador", [
            "morador" => $morador
        ]);
    }

    public function perfil(?array $dados): void
    {
        $usuario = Autenticacao::usuario();
        $encomendas = new Encomenda();
        $moradores = (new Morador())->buscar("usuario_id = {$usuario->id}")->contagem();
        $encomendas_retirar = $encomendas->buscar("data_entrega is NULL")->buscarPorUsuario($usuario->id)->contagem();
        $encomendas_recebidas = $encomendas->buscarPorUsuario($usuario->id)->contagem();
        $apartamento = (new Apartamento())->buscarPorUsuario($usuario->id);

        echo $this->visao->render("cadastros/perfil", [
            "usuario" => $usuario,
            "encomendas_recebidas" => $encomendas_recebidas,
            "encomendas_retirar" => $encomendas_retirar,
            "apartamento" => $apartamento,
            "moradores" => $moradores
        ]);
    }

    public function editPerfil(?array $dados): void
    {
        $usuario = Autenticacao::usuario();

        if (!empty($dados["acao"]) && $dados['acao'] == "atualizar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $usuarioAtualizar = (new Usuario())->buscarPorId($usuario->id);

            if (!$usuarioAtualizar) {
                $this->mensagem->erro("Este usuário não existe")->flash();
                echo json_encode(["redirect" => url("/perfil")]);
                return;
            }

            $usuarioAtualizar->nome = $dados["nome"];
            $usuarioAtualizar->sobrenome = $dados["sobrenome"];
            $usuarioAtualizar->email = $dados["email"];

            if ($dados['senha'] != $dados['senha_confirme']) {
                $json["mensagem"] = $this->mensagem->aviso("As senhas não conferem")->render();
                echo json_encode($json);
                return;
            }

            if ($dados['senha'] != '') {
                $usuarioAtualizar->senha = $dados["senha"];
            }
            $usuarioAtualizar->nascimento = data_fmt_back($dados["nascimento"]);
            $usuarioAtualizar->telefone = $dados["telefone"];

            if (!$usuarioAtualizar->salvar()) {
                $json["mensagem"] = $usuarioAtualizar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Usuário atualizado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        echo $this->visao->render("cadastros/edit_perfil", [
            "usuario" => $usuario
        ]);
    }

    public function detalheMorador(?array $dados): void
    {
        $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
        $morador = (new Morador())->buscarPorId($id);
        echo $this->visao->render("cadastros/detalhe_morador", [
            'morador' => $morador
        ]);
    }

}