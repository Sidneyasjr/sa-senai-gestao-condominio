<?php


namespace Source\Models;


use Source\Core\Modelo;

/**
 * Class Usuario
 * @package Source\Models
 */
class Usuario extends Modelo
{
    /**
     * Usuario constructor.
     */
    public function __construct()
    {
        parent::__construct("usuarios", ["id"], ["nome", "sobrenome", "email", "senha"]);
    }

    /**
     * @param string $nome
     * @param string $sobrenome
     * @param string $email
     * @param string $senha
     * @param int $tipo
     * @param int $ativo
     * @return $this
     */
    public function cadastro(string $nome, string $sobrenome, string $email, string $senha, int $tipo = 1, int $ativo = 1): Usuario
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo = $tipo;
        $this->ativo = $ativo;
        return $this;
    }

    /**
     * @param string $email
     * @param string $colunas
     * @return Usuario|null
     */
    public function buscaPorEmail(string $email, string $colunas = "*"): ?Usuario
    {
        $buscar = $this->buscar("email = :email", "email={$email}", $colunas);
        return $buscar->fetch();
    }

    public function nomeCompleto(): string
    {
        return "{$this->nome} {$this->sobrenome}";
    }

    public function buscarPorApartamento(string $apartamento_id, string $colunas = "*"): ?Usuario
    {
        $buscar = $this->buscar("apartamento_id = :apartamento_id", "apartamento_id={$apartamento_id}", $colunas);
        return $buscar->fetch();
    }

    public function moradores(): array
    {
        $moradores = $this->buscar("tipo = 1 AND ativo = 1");
        return $moradores->fetchall();
    }

    public function sindicos(): array
    {
        $moradores = $this->buscar("tipo = 3 AND ativo = 1");
        return $moradores->fetchall();
    }

    public function porteiros(): array
    {
        $moradores = $this->buscar("tipo = 2 AND ativo = 1");
        return $moradores->fetchall();
    }

    /**
     * @return bool
     */
    public function salvar(): bool
    {
        if (!$this->requerido()) {
            $this->mensagem->aviso("Nome, Sobrenome, email e senha são campos obrigatórios");
            return false;
        }

        if (!is_email($this->email)) {
            $this->mensagem->aviso("O e-mail informado nã tem um formato valido");
            return false;
        }

        if (!is_senha($this->senha)) {
            $min = CONF_SENHA_MIN_LEN;
            $max = CONF_SENHA_MAX_LEN;
            $this->mensagem->aviso("A senha teve ter entre {$min} e {$max} caracteres");
            return false;
        } else {
            $this->senha = senha($this->senha);
        }


        /** Atualiza Usuario */
        if (!empty($this->id)) {
            $usuarioId = $this->id;
            if ($this->buscar("email = :e and id != :i", "e={$this->email}&i={$usuarioId}", "id")->fetch()) {
                $this->mensagem->aviso("O email informado já está cadastrado");
                return false;
            }
            $this->atualizar($this->seguro(), "id = :id", "id={$usuarioId}");
            if ($this->falha()) {
                $this->mensagem->erro("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** Cria Usuario */
        if (empty($this->id)) {
            if ($this->buscaPorEmail($this->email, "id")) {
                $this->mensagem->aviso("O e-mail informado já está cadastrado");
                return false;
            }
            $usuarioId = $this->criar($this->seguro());
            if ($this->falha()) {
                $this->mensagem->erro("Erro ao cadastrar, verifique os dados");
                return false;
            }

        }

        $this->dados = ($this->buscarPorId($usuarioId))->dados();
        return true;
    }

}