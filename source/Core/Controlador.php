<?php


namespace Source\Core;


use Source\Support\Mensagem;

class Controlador
{
    protected $visao;
    protected $mensagem;

    public function __construct(string $pastaDaVisao = null)
    {
        $this->visao = new Visao($pastaDaVisao);
        $this->mensagem = new Mensagem();
    }
}