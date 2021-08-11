<?php


namespace Source\Models;


use Source\Core\Modelo;

class Morador extends Modelo
{
    public function __construct()
    {
        parent::__construct(
            'moradores',
            ['id'],
            [
                'nome',
                'sobrenome',
                'documento',
                'nascimento',
                'email',
                'telefone',
                'usuario_id',
            ]);
    }

    public function cadastro(
        string $nome,
        string $sobrenome,
        string $documento,
        string $nascimento,
        string $email,
        string $telefone,
        string $usuario_id
    )
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->documento = $documento;
        $this->nascimento = $nascimento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->usuario_id = $usuario_id;
        return $this;
    }


    public function buscaPorNome(string $nome, string $colunas = "*"): array
    {
        $buscar = $this->buscar("nome like :nome", "nome=%{$nome}%", $colunas);
        return $buscar->fetchall();
    }

    public function buscaPorApartamento(string $apartamento, string $colunas = "*")
    {
        return $this->buscar("apartamento_id = :apartamento_id", "apartamento_id={$apartamento}", $colunas);
    }

    public function buscaPorUsuario(string $usuario_id, string $colunas = "*"): array
    {
        $buscar = $this->buscar("usuario_id = :usuario_id", "usuario_id={$usuario_id}", $colunas);
        return $buscar->fetchall();
    }

    public function apartamento(): ?string
    {
        if ($this->apartamento_id) {
            $apartamento = (new Apartamento())->buscarPorId($this->apartamento_id);
            return "Apto: {$apartamento->apartamento} - Torre: {$apartamento->torre}";
        }
        return null;
    }

    public function usuario(): ?Modelo
    {
        if ($this->usuario_id){
            return (new Usuario())->buscarPorId($this->usuario_id);
        }
        return null;
    }

    public function nomeCompleto(): string
    {
        return "{$this->nome} {$this->sobrenome}";
    }

}