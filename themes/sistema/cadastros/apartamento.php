<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/apartamentos") ?>">Apartamentos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="align-items-center">
                <div class="ajax_response"><?= flash(); ?></div>
            </div>
            <?php if (!isset($apartamento)): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Novo Apartamento</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/apartamento") ?>" method="post">
                            <input type="hidden" name="acao" value="criar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="id">ID</label>
                                            <input type="number" id="id" class="form-control" placeholder="0000"
                                                   value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="torre">Torre</label>
                                            <input type="text" min="0" id="torre" class="form-control"
                                                   placeholder="Informe a torre" name="torre">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="form-control-label" for="apartamento">Apartamento</label>
                                            <input type="text" id="apartamento" name="apartamento" class="form-control"
                                                   placeholder="Informe o apartamento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="usuario_id">Morador Principal</label>
                                            <select id="usuario_id" name="usuario_id" class="form-control select2">
                                                <option value="0">-</option>
                                                <?php if (isset($usuarios)) {
                                                    foreach ($usuarios as $usuario): ?>
                                                        <option value="<?= $usuario->id ?>"><?= "{$usuario->nome} - {$usuario->email}" ?></option>
                                                    <?php endforeach;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row align-items-center">
                                    <div class="col-1 text-right">
                                        <button class="btn btn-sm btn-primary">SALVAR</button>
                                    </div>
                                    <div class="col-1 text-right">
                                        <a href="<?= url("/apartamentos") ?>" class="btn btn-sm btn-danger">CANCELAR</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><?= "Apartamento: {$apartamento->apartamento} - Torre: {$apartamento->torre}" ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/apartamento/{$apartamento->id}") ?>" method="post">
                            <input type="hidden" name="acao" value="atualizar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="id">ID</label>
                                            <input type="number" id="id" class="form-control"
                                                   value="<?= $apartamento->id ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="torre">Torre</label>
                                            <input type="text" min="0" id="torre" name="torre" class="form-control"
                                                   value="<?= $apartamento->torre ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="apartamento">Apartamento</label>
                                            <input type="text" id="apartamento" name="apartamento" class="form-control"
                                                   value="<?= $apartamento->apartamento ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="usuario_id">Usuario</label>
                                            <select id="usuario_id"
                                                    name="usuario_id" <?= $apartamento->usuario_id == null ? "" : "disabled" ?>
                                                    class="form-control select2">
                                                <?php
                                                $usuario_id = $apartamento->usuario_id;
                                                $select = function ($value) use ($usuario_id) {
                                                    return ($usuario_id == $value ? "selected" : "0");
                                                }
                                                ?>
                                                <option value="0">-</option>
                                                <?php if (isset($usuarios)) {
                                                    foreach ($usuarios as $usuario): ?>
                                                        <option <?= $select($usuario->id); ?>
                                                                value="<?= $usuario->id ?>"><?= "{$usuario->nome} - {$usuario->email}" ?></option>
                                                    <?php endforeach;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div>
                                    <button class="btn btn-sm btn-primary mb-2" style="width:90px;">SALVAR</button>
                                </div>
                                <div class="ml-2">
                                    <a href="<?= url('apartamento') ?>" class="btn btn-sm btn-success mb-2"
                                       style="width:90px;">NOVO</a>
                                </div>
                                <div class="ml-auto">
                                    <a href="<?= url('apartamentos') ?>" class="btn btn-sm btn-warning mb-2"
                                       style="width:90px;">CANCELAR</a>
                                </div>
                                <?php if ($apartamento->usuario_id): ?>
                                    <div class="ml-2">
                                        <a href="#" class="btn btn-sm btn-danger" style="width:100px;"
                                           data-post="<?= url("/apartamento/{$apartamento->id}"); ?>"
                                           data-acao="desocupar"
                                           data-confirm="Tem certeza que deseja desocupar este apartamento?"
                                           data-apartamento_id="<?= $apartamento->id; ?>">DESOCUPAR</a>
                                    </div>
                                <?php endif; ?>
                                <?php if (!$apartamento->usuario_id): ?>
                                    <div class="ml-2">
                                        <a href="#" class="btn btn-sm btn-danger" style="width:90px;"
                                           data-post="<?= url("/apartamento/{$apartamento->id}"); ?>"
                                           data-acao="delete"
                                           data-confirm="Tem certeza que deseja excluir este apartamento?"
                                           data-apartamento_id="<?= $apartamento->id; ?>">EXCLUIR</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
