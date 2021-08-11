<?php


namespace Source\App;

use Source\Core\Controlador;
use Source\Models\Autenticacao;
use Source\Models\Usuario;

class Web extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VISAO_SISTEMA . "/");
    }

    public function login(?array $dados): void
    {
        if (Autenticacao::usuario()) {
            redirect("/home");
        }

        if (!empty($dados['csrf'])) {
            if (!csrf_verify($dados)) {
                $json['mensagem'] = $this->mensagem->erro("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (empty($dados['email']) || empty($dados['senha'])) {
                $json['mensagem'] = $this->mensagem->aviso("Informe o seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $salvo = !empty($dados['salvo']);
            $autenticacao = new Autenticacao();
            $login = $autenticacao->login($dados['email'], $dados['senha'], $salvo);

            if ($login) {
                $this->mensagem->sucesso("Seja bem-vindo(a) de volta " . Autenticacao::usuario()->nome . "!")->flash();
                $json['redirect'] = url("/home");
            } else {
                $json['mensagem'] = $autenticacao->mensagem()->antes("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }
        echo $this->visao->render("autenticacao/login", [
            "cookie" => filter_input(INPUT_COOKIE, "emailAutenticado")
        ]);
    }

    public function registro(?array $dados): void
    {
        if (Autenticacao::usuario()) {
            redirect("/home");
        }
        if (!empty($dados['csrf'])) {
            if (!csrf_verify($dados)) {
                $json['mensagem'] = $this->mensagem->erro("Erro ao enviar, favor use o formulário")->render();
                echo json_encode($json);
                return;
            }

            if (in_array("", $dados)) {
                $json['mensagem'] = $this->mensagem->aviso("Informe seus dados para criar sua conta.")->render();
                echo json_encode($json);
                return;
            }

            if ($dados['senha'] != $dados['senha_confirme'] ) {
                $json['mensagem'] = $this->mensagem->aviso("As senhas não conferem")->render();
                return;
            }

            $autenticacao = new Autenticacao();
            $usuario = new Usuario();
            $usuario->cadastro(
                $dados['nome'],
                $dados['sobrenome'],
                $dados['email'],
                $dados['senha']
            );

            if ($autenticacao->registro($usuario)) {
                $this->mensagem->sucesso("Parabens, seu usuário foi criado com sucesso")->flash();
                $json['redirect'] = url("/");
            } else {
                $json['mensagem'] = $autenticacao->mensagem()->antes("Ooops! ")->render();
            }

            echo json_encode($json);
            return;
        }

        echo $this->visao->render("autenticacao/registro", []);
    }

    public function error(array $dados): void
    {
        $error = new \stdClass();

        switch ($dados['errcode']) {
            case "problemas":
                $error->code = "OPS";
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está diponível no momento. Já estamos vendo isso mas caso precise, envie um e-mail :)";
                $error->linkTitle = "ENVIAR E-MAIL";
                $error->link = null;
                break;

            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção!";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo para você controlar melhor as suas contas :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $dados['errcode'];
                $error->title = "Ooops. Conteúdo indispinível :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }


        echo $this->visao->render("error", [
            "error" => $error
        ]);
    }

}