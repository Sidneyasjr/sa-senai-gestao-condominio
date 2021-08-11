<?php


namespace Source\Core;


use League\Plates\Engine;

class Visao
{
    private $engine;

    public function __construct(string $pasta = CONF_VISAO_PASTA, string $ext = CONF_VISAO_EXT)
    {
        $this->engine = Engine::create($pasta, $ext);
    }

    public function pasta(string $nome, string $pasta): Visao
    {
        $this->engine->addFolder($nome, $pasta);
        return $this;
    }

    public function render(string $nomeTemplate, array $dados): string
    {
        return $this->engine->render($nomeTemplate, $dados);
    }

    public function engine(): Engine
    {
        return $this->engine();
    }
}