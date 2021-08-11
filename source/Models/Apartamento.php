<?php


namespace Source\Models;


use Source\Core\Modelo;

class Apartamento extends Modelo
{
    public function __construct()
    {
        parent::__construct("apartamentos", ["id"], ["torre", "apartamento"]);
    }

    public function cadastro(string $torre, string $apartamento): Apartamento
    {
        $this->torre = $torre;
        $this->apartamento = $apartamento;
        return $this;
    }

    public function buscaPorTorre(string $torre, string $colunas = "*"): ?array
    {
        $buscar = $this->buscar("torre = :torre", "torre={$torre}", $colunas);
        return $buscar->fetchall();
    }

    public function buscarPorUsuario(string $usuario_id, string $colunas = "*"): ?Apartamento
    {
        $buscar = $this->buscar("usuario_id = :usuario_id", "usuario_id={$usuario_id}", $colunas);
        return $buscar->fetch();
    }

}