<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/encomendas") ?>">Encomendas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Encomenda</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
                <div class="card-header">
                    <div class="align-items-center">
                        <div class="text-center">
                            <h2 class="mb-0">Detalhe Encomenda</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="description"> <i class="fas fa-shipping-fast text-danger"></i> Data Recebimento </span>
                                    <span class="heading"><?= data_fmt_br($encomenda->data_recebimento) ?></span>
                                </div>
                                <div>
                                    <span class="description"> <i class="fas fa-shipping-fast text-danger"></i> Data entrega</span>
                                    <span class="heading"><?= data_fmt_br($encomenda->data_entrega) ?></span>
                                </div>
                                <div>
                                    <span class="description"><i
                                                class="fas fa-building text-danger"></i> Destinatário</span>
                                    <span class="heading"><?= $encomenda->destinatario ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-profile-stats d-flex justify-content-center">
                        <div>
                            <span class="description"><i class="ni ni-send text-danger"></i> Remetente</span>
                            <span class="heading"><?= $encomenda->remetente ?></span>
                        </div>
                        <div>
                            <span class="description"><i class="ni ni-compass-04 text-danger"></i> ID</span>
                            <span class="heading"><?= $encomenda->id ?></span>
                        </div>
                        <div>
                            <span class="description"><i class="ni ni-compass-04 text-danger"></i> Recebido Por </span>
                            <span class="heading"><?= usuarioNomeCompleto($encomenda->porteiro_recebeu) ?></span>
                        </div>
                        <div>
                            <span class="description"><i class="ni ni-compass-04 text-danger"></i> Entregue Por </span>
                            <span class="heading"><?= usuarioNomeCompleto($encomenda->porteiro_entregou) ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= url('/encomendas') ?>" class="btn btn-danger btn-block">VOLTAR</a>
                </div>
            </div>
        </div>
    </div>
</div>



















