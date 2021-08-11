<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Moradores</h5>
                            <span class="h2 font-weight-bold mb-0"><?= $qtdMoradores ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Apartamentos</h5>
                            <span class="h2 font-weight-bold mb-0"><?= $qtdApartamentos ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Encomendas</h5>
                            <span class="h2 font-weight-bold mb-0"><?= $qtdEncomendas ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Usuários</h5>
                            <span class="h2 font-weight-bold mb-0"><?= $qtdUsuarios ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="align-items-center">
                <div class="ajax_response"><?= flash(); ?></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Novas Encomendas</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="<?= url("/encomendas") ?>" class="btn btn-sm btn-primary">Ver Todas</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table table-sm table-striped table-bordered text-center" style="width:100%">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Recebimento</th>
                                    <th scope="col">Destinario</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($encomendas)) {
                                    foreach ($encomendas as $encomenda): ?>
                                        <tr>
                                            <?php if (!morador(\Source\Models\Autenticacao::usuario())): ?>
                                                <td><a href="<?= url("/encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                            <?php else: ?>
                                                <td><a href="<?= url("/detalhe-encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                            <?php endif; ?>
                                            <td><?= data_fmt_br($encomenda->data_recebimento) ?></td>
                                            <td><?= $encomenda->destinatario ?></td>
                                        </tr>
                                    <?php endforeach;
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Não identificadas</h3>
                                </div>
                                <div class="col text-right">
                                    <a href="<?= url("/encomendas") ?>" class="btn btn-sm btn-primary">Ver Todas</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table table-sm table-striped table-bordered text-center" style="width:100%">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Recebimento</th>
                                    <th scope="col">Destinario</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($encomendasNaoIdentificadas)) {
                                    foreach ($encomendasNaoIdentificadas as $encomenda): ?>
                                        <tr>
                                            <?php if (!morador(\Source\Models\Autenticacao::usuario())): ?>
                                                <td><a href="<?= url("/encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                            <?php else: ?>
                                                <td><a href="<?= url("/detalhe-encomenda/{$encomenda->id}") ?>"><?= $encomenda->id ?></a></td>
                                            <?php endif; ?>
                                            <td><?= data_fmt_br($encomenda->data_recebimento) ?></td>
                                            <td><?= $encomenda->destinatario ?></td>
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
    </div>
</div>

