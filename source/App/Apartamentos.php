<?php


namespace Source\App;


use Source\Core\Controlador;
use Source\Models\Apartamento;
use Source\Models\Autenticacao;
use Source\Models\Morador;
use Source\Models\Usuario;

class Apartamentos extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VISAO_SISTEMA . "/");

        if (!$this->usuario = Autenticacao::usuario()) {
            $this->mensagem->aviso("Efetue login para acessar o APP.")->flash();
            redirect("/");
        }

        if (!sindico(Autenticacao::usuario())) {
            $this->mensagem->aviso("Voce não tem permissão para acessar essa pagina.")->flash();
            redirect("/");
        }
    }

    public function apartamentos(): void
    {
        $apartamentos = (new Apartamento())->buscar()->fetchall();
        echo $this->visao->render("listas/apartamentos", [
            "apartamentos" => $apartamentos
        ]);
    }

    public function apartamento(?array $dados): void
    {
        $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
        //criar
        if (!empty($dados["acao"]) && $dados["acao"] == "criar") {
            $novoApartamento = new Apartamento();
            $novoApartamento->torre = $dados["torre"];
            $novoApartamento->apartamento = $dados["apartamento"];
            if ($dados["usuario_id"] == "0") {
                $novoApartamento->usuario_id = null;
            } else {
                $novoApartamento->usuario_id = $dados["usuario_id"];
            }


            if (!$novoApartamento->salvar()) {
                $json['mensagem'] = $novoApartamento->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Apartamento cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/apartamento/{$novoApartamento->id}");
            echo json_encode($json);
            return;
        }

        //atualizar
        if (!empty($dados["acao"]) && $dados['acao'] == "atualizar") {
            $apartamentoAtualizar = (new Apartamento())->buscarPorId($dados["id"]);
            if (!$apartamentoAtualizar) {
                $this->mensagem->erro("Este apartamento não existe")->flash();
                echo json_encode(["redirect" => url("/apartamentos")]);
                return;
            }

            $apartamentoAtualizar->torre = $dados["torre"];
            $apartamentoAtualizar->apartamento = $dados["apartamento"];

            if (!$apartamentoAtualizar->usuario_id) {
                if ($dados["usuario_id"] == "0") {
                    $apartamentoAtualizar->usuario_id = null;
                } else {
                    $apartamentoAtualizar->usuario_id = intval($dados["usuario_id"]);
                }
            }

            if (!$apartamentoAtualizar->salvar()) {
                $json["mensagem"] = $apartamentoAtualizar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Apartamento atualizado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //deletar
        if (!empty($dados["acao"]) && $dados["acao"] == "delete") {
            $apartamentoDeletar = (new Apartamento())->buscarPorId($dados["id"]);

            if (!$apartamentoDeletar) {
                $this->mensagem->erro("Você tentou deletar um apartamento que não existe")->flash();
                echo json_encode(["redirect" => url("/apartamentos")]);
                return;
            }

            $apartamentoDeletar->excluir();
            $this->mensagem->sucesso("Apartamento foi excluído com sucesso...")->flash();
            echo json_encode(["redirect" => url("/apartamentos")]);
            return;
        }

        //desocupar
        if (!empty($dados["acao"]) && $dados['acao'] == "desocupar") {
            $apartamentoDesocupar = (new Apartamento())->buscarPorId($dados["id"]);
            if (!$apartamentoDesocupar) {
                $this->mensagem->erro("Este apartamento não existe")->flash();
                echo json_encode(["redirect" => url("/apartamentos")]);
                return;
            }

            $apartamentoDesocupar->usuario_id = null;

            $moradores = (new Morador())->buscaPorApartamento($apartamentoDesocupar->id)->fetchall();
            foreach ($moradores as $morador) {
                $this->desocupar($apartamentoDesocupar->id);
            }

            if (!$apartamentoDesocupar->salvar()) {
                $json["mensagem"] = $apartamentoDesocupar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Apartamento atualizado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        $apartamento = null;
        if (!empty($dados["id"])) {
            $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
            $apartamento = (new Apartamento())->buscarPorId($id);
        }

        $usuarios = (new Usuario())->moradores();
        echo $this->visao->render("cadastros/apartamento", [
            "apartamento" => $apartamento,
            "usuarios" => $usuarios
        ]);
    }

    private function desocupar(int $apartamento_id)
    {
        $morador = (new Morador())->buscaPorApartamento($apartamento_id)->fetch();
        $morador->data_saida = date('Y-m-d');
        $morador->apartamento_id = null;
        $morador->salvar();
    }
}