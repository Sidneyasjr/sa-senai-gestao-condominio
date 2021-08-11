<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Encomendas</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="align-items-center">
                <div class="ajax_response"><?= flash(); ?></div>
            </div>
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Encomendas</h3>
                        </div>
                        <?php if (!morador(\Source\Models\Autenticacao::usuario())): ?>
                            <div class="col text-right">
                                <a href="<?= url("/encomenda") ?>" class="btn btn-sm btn-primary">Nova Encomenda</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="encomendas" data-order='[[ 1, "desc" ]]' class="table table-striped table-bordered text-center" style="width:100%">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Recebimento</th>
                            <th scope="col">Entrega</th>
                            <th scope="col">Morador</th>
                            <th scope="col">Destinario</th>
                            <th scope="col">Remetente</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($encomendas)) {
                            foreach ($encomendas as $encomenda): ?>
                                <tr class="<?= $encomenda->morador_id == null ? "bg-yellow" : "" ?>">
                                    <?php if (!morador(\Source\Models\Autenticacao::usuario())): ?>
                                        <td><a href="<?= url("/encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                    <?php else: ?>
                                        <td><a href="<?= url("/detalhe-encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                    <?php endif; ?>
                                    <td><?= data_fmt_br($encomenda->data_recebimento) ?></td>
                                    <td><?= data_fmt_br($encomenda->data_entrega) ?></td>
                                    <td><?= $encomenda->morador_id == null ? "Não identificado" : buscarMorador($encomenda->morador_id) ?></td>
                                    <td><?= $encomenda->destinatario ?></td>
                                    <td><?= $encomenda->remetente ?></td>
                                </tr>
                            <?php endforeach;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
