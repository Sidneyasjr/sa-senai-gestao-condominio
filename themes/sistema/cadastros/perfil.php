<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-8 ">
            <div class="card card-profile">
                <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <div class="d-flex justify-content-between">
                        <a href="<?= url("edit-perfil") ?>" class="btn btn-sm btn-info  mr-4 ">Editar cadastro</a>
                        <a href="<?= url('encomendas') ?>" class="btn btn-sm btn-default float-right">Encomendas</a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading"><?= $encomendas_retirar ?></span>
                                    <span class="description"> <i class="fas fa-shipping-fast text-danger"></i> Retirar </span>
                                </div>
                                <div>
                                    <span class="heading"><?= $encomendas_recebidas ?></span>
                                    <span class="description"> <i class="fas fa-shipping-fast text-danger"></i> Recebidas</span>
                                </div>
                                <div>
                                    <span class="heading"><?= $moradores ?></span>
                                    <span class="description"> <i class="fas fa-users text-danger"></i> Moradores</span>
                                </div>
                                <?php if (isset($apartamento)): ?>
                                    <div>
                                        <span class="heading"><?= "{$apartamento->apartamento} - {$apartamento->torre}" ?></span>
                                        <span class="description"><i class="fas fa-building text-danger"></i> Apto - Torre</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="h3">
                            <?= "{$usuario->nome} {$usuario->sobrenome}" ?><span
                                    class="font-weight-light">, <?= calc_idade($usuario->nascimento) ?></span>
                        </h5>
                        <div class="h5 font-weight-300">
                            <i class="ni location_pin mr-2"></i><?= $usuario->email ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
</div>
