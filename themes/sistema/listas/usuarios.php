<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Usuários</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Usuários</h3>
                        </div>
                        <div class="col text-right">
                            <a href="<?= url("/usuario") ?>" class="btn btn-sm btn-primary">Novo Usuário</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="usuarios" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($usuarios)) {
                            foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><a href="<?= url("/usuario/{$usuario->id}") ?>"><?= $usuario->id ?></a></td>
                                <td><?= $usuario->nome ?></td>
                                <td><?= $usuario->tipo ?></td>
                                <td><?= $usuario->ativo ?></td>
                                <td><?= $usuario->email ?></td>
                            </tr>
                            <?php endforeach;
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
