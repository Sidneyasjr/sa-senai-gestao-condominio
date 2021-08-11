<?php


namespace Source\Support;


use Source\Core\Sessao;

class Mensagem
{
    private $texto;
    private $tipo;
    private $antes;
    private $depois;

    public function __toString()
    {
        return $this->render();
    }

    public function getTexto(): ?string
    {
        return $this->antes . $this->texto . $this->depois;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function antes(string $texto): Mensagem
    {
        $this->antes = $texto;
        return $this;
    }

    public function depos(string  $texto): Mensagem
    {
        $this->depois = $texto;
        return $this;
    }

    public function padrao(string $mensagem): Mensagem
    {
        $this->tipo = "alert-primary";
        $this->texto = $this->filtro($mensagem);
        return $this;
    }

    public function info(string $mensagem): Mensagem
    {
        $this->tipo = "alert-info";
        $this->texto = $this->filtro($mensagem);
        return $this;
    }

    public function sucesso(string $mensagem): Mensagem
    {
        $this->tipo = "alert-success";
        $this->texto = $this->filtro($mensagem);
        return $this;
    }

    public function aviso(string $mensagem): Mensagem
    {
        $this->tipo = "alert-warning";
        $this->texto = $this->filtro($mensagem);
        return $this;
    }

    public function erro(string $mensagem): Mensagem
    {
        $this->tipo = "alert-danger";
        $this->texto = $this->filtro($mensagem);
        return $this;
    }

    public function render(): string
    {
        return "<div class='alert {$this->getTipo()}' role='alert'>{$this->getTexto()}</div>";
    }


    public function flash(): void
    {
        (new Sessao())->set("flash", $this);
    }

    private function filtro(string $mensagem): string
    {
        return filter_var($mensagem, FILTER_SANITIZE_STRIPPED);
    }

}