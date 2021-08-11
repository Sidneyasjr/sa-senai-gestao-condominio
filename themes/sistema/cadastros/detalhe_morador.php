<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/moradores") ?>">Moradores</a></li>
                <li class="breadcrumb-item active" aria-current="page">Morador</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header">
                    <div class="align-items-center">
                        <div class="text-center">
                            <h3 class="mb-0">DETALHES DO MORADOR</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading"><?= $morador->nome ?></span>
                                    <span class="description"> <i class="ni ni-single-02 text-danger"></i> Nome </span>
                                </div>
                                <div>
                                    <span class="heading"><?= $morador->sobrenome ?></span>
                                    <span class="description"> <i class="ni ni-single-02 text-danger"></i> Sobrenome</span>
                                </div>
                                <div>
                                    <span class="heading"><?= $morador->documento ?></span>
                                    <span class="description"><i class="ni ni-badge text-danger"></i> Documento</span>
                                </div>
                                <div>
                                    <span class="heading"><?= data_fmt($morador->nascimento) ?></span>
                                    <span class="description"><i class="fas fa-building text-danger"></i> Nascimento</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-profile-stats d-flex justify-content-center">
                        <div>
                            <span class="heading"><?= $morador->email ?></span>
                            <span class="description"><i class="ni ni-email-83 text-danger"></i> Email</span>
                        </div>
                        <div>
                            <span class="heading"><?= $morador->telefone ?></span>
                            <span class="description"><i class="ni ni-mobile-button text-danger"></i> Telefone</span>
                        </div>
                    </div>
                    <div class="card-profile-stats d-flex justify-content-center">
                        <div>
                            <span class="heading"><?= $morador->id ?></span>
                            <span class="description"><i class="ni ni-compass-04 text-danger"></i> ID Usuário </span>
                        </div>
                        <div>
                            <span class="heading"><?= buscarApto($morador->apartamento_id) ?></span>
                            <span class="description"><i class="fas fa-building text-danger"></i> Apartamento </span>
                        </div>
                        <div>
                            <span class="heading"><?= data_fmt($morador->data_entrada) ?></span>
                            <span class="description"><i
                                        class="ni ni-calendar-grid-58 text-danger"></i> Data de entrada </span>
                        </div>
                        <div>
                            <span class="heading"><?= data_fmt($morador->data_saida) ?></span>
                            <span class="description"><i
                                        class="ni ni-calendar-grid-58 text-danger"></i> Data de saída </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= url('/moradores') ?>" class="btn btn-danger btn-block">VOLTAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



















