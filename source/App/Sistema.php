<?php


namespace Source\App;


use Source\Core\Controlador;
use Source\Models\Apartamento;
use Source\Models\Autenticacao;
use Source\Models\Encomenda;
use Source\Models\Morador;
use Source\Models\Usuario;

class Sistema extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VISAO_SISTEMA . "/");

        if (!$this->usuario = Autenticacao::usuario()) {
            $this->mensagem->aviso("Efetue login para acessar o APP.")->flash();
            redirect("/");
        }

    }

    public function sair(): void
    {
        $this->mensagem->sucesso("Você saiu com sucesso " . Autenticacao::usuario()->nome . ". Volte logo :)")->flash();

        Autenticacao::sair();
        redirect('/');
    }

    public function home(): void
    {
        $encomendas = new Encomenda();
        if (Autenticacao::usuario()->tipo == "MORADOR") {
            $encomendas = $encomendas->buscar("data_entrega is NULL")->buscarPorUsuario(Autenticacao::usuario()->id)->ordem('data_recebimento desc')->fetchall();
        } else {
            $encomendas = $encomendas->buscar("data_entrega is NULL")->ordem('data_recebimento desc')->limite(10)->fetchall();
        }

        $qtdMoradores = (new Morador())->buscar()->contagem();
        $qtdApartamentos = (new Apartamento())->buscar()->contagem();
        $qtdEncomendas = (new Encomenda())->buscar()->contagem();
        $qtdUsuarios = (new Usuario())->buscar()->contagem();
        $encomendasNaoIdentificadas = (new Encomenda())->buscar("morador_id is null")->ordem('data_recebimento desc')->limite(10)->fetchall();
        echo $this->visao->render("home", [
            "encomendas" => $encomendas,
            "qtdMoradores" => $qtdMoradores,
            "qtdApartamentos" => $qtdApartamentos,
            "qtdEncomendas" => $qtdEncomendas,
            "qtdUsuarios" => $qtdUsuarios,
            "encomendasNaoIdentificadas" => $encomendasNaoIdentificadas
        ]);
    }
}