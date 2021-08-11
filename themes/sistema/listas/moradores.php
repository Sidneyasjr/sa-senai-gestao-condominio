<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Moradores</li>
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
                            <h3 class="mb-0">Moradores Cadastrados</h3>
                        </div>
                        <?php if (morador(\Source\Models\Autenticacao::usuario())): ?>
                            <div class="col text-right">
                                <a href="<?= url("/morador") ?>" class="btn btn-sm btn-primary">Novo Morador</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="moradores" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Apartamento</th>
                            <th scope="col">Data de Entrada</th>
                            <th scope="col">Data de Saída</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($moradores)) {
                            foreach ($moradores as $morador): ?>
                                <tr>
                                    <?php if (morador(\Source\Models\Autenticacao::usuario())): ?>
                                        <td><a href="<?= url("/morador/{$morador->id}") ?>"><?= $morador->id ?></a></td>
                                    <?php else: ?>
                                        <td><a href="<?= url("/detalhe-morador/{$morador->id}") ?>"><?= $morador->id ?></a></td>
                                    <?php endif; ?>
                                    <td><?= "{$morador->nome} {$morador->sobrenome}" ?></td>
                                    <td><?= $morador->apartamento_id == null ? "" : buscarApto(intval($morador->apartamento_id)) ?></td>
                                    <td><?= data_fmt($morador->data_entrada, "d/m/Y") ?></td>
                                    <td><?= data_fmt($morador->data_saida, "d/m/Y") ?></td>
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
