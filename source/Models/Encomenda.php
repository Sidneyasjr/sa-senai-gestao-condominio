<?php


namespace Source\Models;


use Source\Core\Modelo;

class Encomenda extends Modelo
{
    public function __construct()
    {
        parent::__construct("encomendas", ["id"], ["destinatario", "remetente", "data_recebimento"]);
    }

    public function cadastro(string $destinatario, string $remetente, string $data_recebimento): Encomenda
    {
        $this->destinatario = $destinatario;
        $this->remetente = $remetente;
        $this->data_recebimento = $data_recebimento;
        return $this;
    }

    public function buscaPorMorador(string $morador_id, string $colunas = "*"): array
    {
        $buscar = $this->buscar("morador_id = :morador_id or morador_id is null", "morador_id={$morador_id}", $colunas)->ordem('data_recebimento desc');
        return $buscar->fetchall();
    }

    public function buscarPorUsuario(string $usuario_id)
    {
        $colunas = "E.id, E.morador_id, E.destinatario, E.remetente, E.data_recebimento, E.observacao, E.porteiro_recebeu, E.porteiro_entregou, E.data_entrega, M.usuario_id";
        $join = "as E INNER JOIN moradores as M ON M.id = E.morador_id ";
        return $this->buscar("M.usuario_id = :usuario_id", "usuario_id={$usuario_id}", $colunas, $join);
    }
}