<?php


namespace Source\App;


use Source\Core\Controlador;
use Source\Models\Autenticacao;
use Source\Models\Usuario;

class Usuarios extends Controlador
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

    public function usuarios(): void
    {
        $usuarios = (new Usuario())->buscar()->fetchall();
        echo $this->visao->render("listas/usuarios", [
            'usuarios' => $usuarios
        ]);
    }

    public function usuario(?array $dados): void
    {
        if (!empty($dados["acao"]) && $dados["acao"] == "criar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $novoUsuario = new Usuario();
            $novoUsuario->nome = $dados["nome"];
            $novoUsuario->sobrenome = $dados["sobrenome"];
            $novoUsuario->email = $dados["email"];
            $novoUsuario->senha = $dados["senha"];
            $novoUsuario->tipo = $dados["tipo"];
            $novoUsuario->ativo = $dados["ativo"];

            if (!$novoUsuario->salvar()) {
                $json['mensagem'] = $novoUsuario->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Usuario cadastrado com sucesso...")->flash();
            $json["redirect"] = url("/usuario/{$novoUsuario->id}");
            echo json_encode($json);
            return;
        }

        if (!empty($dados["acao"]) && $dados['acao'] == "atualizar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $usuarioAtualizar = (new Usuario())->buscarPorId($dados["id"]);

            if (!$usuarioAtualizar) {
                $this->mensagem->erro("Este usuário não existe")->flash();
                echo json_encode(["redirect" => url("/usuarios")]);
                return;
            }

            $usuarioAtualizar->nome = $dados["nome"];
            $usuarioAtualizar->sobrenome = $dados["sobrenome"];
            $usuarioAtualizar->email = $dados["email"];
            if ($dados['senha'] != '') {
                $usuarioAtualizar->senha = $dados["senha"];
            }
            $usuarioAtualizar->tipo = $dados["tipo"];
            $usuarioAtualizar->ativo = $dados["ativo"];

            if (!$usuarioAtualizar->salvar()) {
                $json["mensagem"] = $usuarioAtualizar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Usuário atualizado com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        $usuario = null;
        if (!empty($dados["id"])) {
            $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
            $usuario = (new Usuario())->buscarPorId($id);
        }

        echo $this->visao->render("cadastros/usuario", [
            "usuario" => $usuario
        ]);
    }
}