<?php


namespace Source\Models;


use Source\Core\Modelo;
use Source\Core\Sessao;

class Autenticacao extends Modelo
{
    public function __construct()
    {
        parent::__construct("usuarios", ["id"], ["email", "senha"]);
    }

    public static function usuario(): ?Modelo
    {
        $sessao = new Sessao();
        if (!$sessao->has("usuAtenticado")) {
            return null;
        }
        return (new Usuario())->buscarPorId($sessao->usuAtenticado);
    }

    public function registro(Usuario $usuario): bool
    {
        if (!$usuario->salvar()) {
            $this->mensagem = $usuario->mensagem;
            return false;
        }

        return true;
    }

    public function login(string $email, string $senha, bool $salvo = false): bool
    {
        if (!is_email($email)) {
            $this->mensagem->aviso("O e-mail informado não é válido");
            return false;
        }

        if ($salvo) {
            setcookie("emailAutenticado", $email, time() + 604800, "/");
        } else {
            setcookie("emailAutenticado", null, time() - 3600, "/");
        }

        if (!is_senha($senha)) {
            $this->mensagem->aviso("A senha informada não é válida");
            return false;
        }

        $usuario = (new Usuario())->buscaPorEmail($email);
        if (!$usuario) {
            $this->mensagem->erro("O e-mail informado não está cadastrado");
            return false;
        }

        if (!senha_verificada($senha, $usuario->senha)) {
            $this->mensagem->erro("A senha informada não confere");
            return false;
        }

        if ($usuario->ativo == 'INATIVO') {
            $this->mensagem->erro("Usuario inativo! Para mais informações entre em contato via email: suporte@gest-residents.com");
            return false;
        }

        if (senha_rehash($usuario->senha)) {
            $usuario->senha = $senha;
            $usuario->salvar();
        }

        (new Sessao())->set("usuAtenticado", $usuario->id);
        $this->mensagem()->sucesso("Login efetuado com sucesso")->flash();
        return true;
    }

    public static function sair(): void
    {
        $sessao = new Sessao();
        $sessao->unset("usuAtenticado");
    }
}