<?php


namespace Source\App;


use Source\Core\Controlador;
use Source\Models\Autenticacao;
use Source\Models\Encomenda;
use Source\Models\Morador;
use Source\Models\Usuario;

class Encomendas extends Controlador
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VISAO_SISTEMA . "/");

        if (!$this->usuario = Autenticacao::usuario()) {
            $this->mensagem->aviso("Efetue login para acessar o APP.")->flash();
            redirect("/");
        }

    }

    public function encomendas(): void
    {
        $encomendas = new Encomenda();
        if (Autenticacao::usuario()->tipo == "MORADOR") {
            $encomendas = $encomendas->buscarPorUsuario(Autenticacao::usuario()->id)->ordem('data_recebimento desc')->fetchall();
        } else {
            $encomendas = $encomendas->buscar()->ordem('data_recebimento desc')->fetchall();
        }
        echo $this->visao->render("listas/encomendas", [
            "encomendas" => $encomendas
        ]);
    }

    public function encomenda(?array $dados): void
    {
        if (Autenticacao::usuario()->tipo == "MORADOR") {
            $this->mensagem->aviso("Voce não tem permissão para acessar essa pagina.")->flash();
            redirect("/");
        }

        if (!empty($dados["acao"]) && $dados["acao"] == "criar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $novaEncomenda = new Encomenda();
            if ($dados["morador_id"]) {
                $novaEncomenda->morador_id = intval($dados["morador_id"]);
            }
            $novaEncomenda->destinatario = $dados["destinatario"];
            $novaEncomenda->remetente = $dados["remetente"];
            $novaEncomenda->data_recebimento = dateTime_fmt_back($dados["data_recebimento"]);
            $novaEncomenda->observacao = $dados["observacao"];
            $novaEncomenda->porteiro_recebeu = intval(Autenticacao::usuario()->id);

            if (!$novaEncomenda->salvar()) {
                $json['mensagem'] = $novaEncomenda->mensagem()->render();
                echo json_encode($json);
                return;
            }
            $this->mensagem->sucesso("Encomenda cadastrada com sucesso...")->flash();
            $json["redirect"] = url("/encomenda/{$novaEncomenda->id}");
            echo json_encode($json);
            return;
        }

        if (!empty($dados["acao"]) && $dados['acao'] == "atualizar") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $encomendaAtualizar = (new Encomenda())->buscarPorId($dados["id"]);
            if (!$encomendaAtualizar) {
                $this->mensagem->erro("Este encomenda não existe")->flash();
                echo json_encode(["redirect" => url("/encomendas")]);
                return;
            }


            $encomendaAtualizar->destinatario = $dados["destinatario"];
            $encomendaAtualizar->remetente = $dados["remetente"];
            $encomendaAtualizar->morador_id = intval($dados["morador_id"]);
            if (!$dados["morador_id"] && $dados["data_entrega"]) {
                $json['mensagem'] = $this->mensagem->aviso("Para colocar a data de entrega é necessario localizar o morador")->render();
                echo json_encode($json);
                return;
            }

            if (!$encomendaAtualizar->data_entrega && $dados["data_entrega"] && $dados["morador_id"]) {
                $encomendaAtualizar->data_entrega = dateTime_fmt_back($dados["data_entrega"]);
                $encomendaAtualizar->porteiro_entregou = intval(Autenticacao::usuario()->id);

            }

            $encomendaAtualizar->observacao = $dados["observacao"];

            if (!$encomendaAtualizar->salvar()) {
                $json["mensagem"] = $encomendaAtualizar->mensagem()->render();
                echo json_encode($json);
                return;
            }

            $this->mensagem->sucesso("Encomenda atualizada com sucesso")->flash();
            echo json_encode(["reload" => true]);
            return;
        }

        //deletar
        if (!empty($dados["acao"]) && $dados["acao"] == "delete") {
            $dados = filter_var_array($dados, FILTER_SANITIZE_STRIPPED);
            $apartamentoDeletar = (new Encomenda())->buscarPorId($dados["id"]);

            if (!$apartamentoDeletar) {
                $this->mensagem->erro("Você tentou deletar uma encomenda que não existe")->flash();
                echo json_encode(["redirect" => url("/encomendas")]);
                return;
            }

            $apartamentoDeletar->excluir();
            $this->mensagem->sucesso("A encomenda foi excluída com sucesso...")->flash();
            echo json_encode(["redirect" => url("/encomendas")]);
            return;
        }

        $encomenda = null;
        $porteiro_recebeu = null;
        $porteiro_entregou = null;
        if (!empty($dados["id"])) {
            $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
            $encomenda = (new Encomenda())->buscarPorId($id);
            $porteiro_recebeu = (new Usuario())->buscarPorId(intval($encomenda->porteiro_recebeu));
            $porteiro_entregou = (new Usuario())->buscarPorId(intval($encomenda->porteiro_entregou));
        }
        $moradores = (new Morador())->buscar()->fetchall();
        echo $this->visao->render("cadastros/encomenda", [
            "encomenda" => $encomenda,
            "moradores" => $moradores,
            "porteiro_recebeu" => $porteiro_recebeu,
            "porteiro_entregou" => $porteiro_entregou
        ]);
    }

    public function detalheEncomenda(?array $dados): void
    {
        $id = filter_var($dados["id"], FILTER_VALIDATE_INT);
        $encomenda = (new Encomenda())->buscarPorId($id);
        echo $this->visao->render("cadastros/detalhe_encomenda", [
            'encomenda' => $encomenda
        ]);
    }

}