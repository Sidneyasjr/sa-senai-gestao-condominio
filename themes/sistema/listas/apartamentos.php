<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Apartamentos</li>
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
                            <h3 class="mb-0">Apartamentos</h3>
                        </div>
                        <div class="col text-right">
                            <a href="<?= url("/apartamento") ?>" class="btn btn-sm btn-primary">Novo Apartamento</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="apartamentos" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Bloco/Torre</th>
                            <th scope="col">Apartamento</th>
                            <th scope="col">QTD Moradores</th>
                            <th scope="col">Livre</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($apartamentos)) {
                            foreach ($apartamentos

                                     as $apartamento): ?>
                                <tr>
                                    <td>
                                        <a href="<?= url("/apartamento/{$apartamento->id}") ?>"><?= $apartamento->id ?></a>
                                    </td>
                                    <td><?= $apartamento->torre ?></td>
                                    <td><?= $apartamento->apartamento ?></td>
                                    <td><?= qtdMoradores($apartamento->id) ?></td>
                                    <?php if (!$apartamento->usuario_id): ?>
                                        <td><i class="fas fa-check text-green"></i></td>
                                    <?php else: ?>
                                        <td><i class="fas fa-times-circle text-red"></i></td>
                                    <?php endif; ?>
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

