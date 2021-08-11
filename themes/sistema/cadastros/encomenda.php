<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/encomendas") ?>">Encomendas</a></li>
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
            <?php if (!isset($encomenda)): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">NOVA ENCOMENDA</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/encomenda") ?>" method="post">
                            <input type="hidden" name="acao" value="criar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label class="form-control-label" for="morador_id">Morador</label>
                                            <select id="morador_id" name="morador_id" class="form-control select2">
                                                <option value="">Selecione um morador cadastrado</option>
                                                <?php if (isset($moradores)) {
                                                    foreach ($moradores as $morador): ?>
                                                        <option value="<?= $morador->id ?>"><?= "{$morador->nome} {$morador->sobrenome} - " . buscarApto($morador->apartamento_id) ?></option>
                                                    <?php endforeach;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_recebimento">Data de
                                                Recebimeto</label>
                                            <input class="form-control" type="datetime-local" name="data_recebimento"
                                                   value=""
                                                   id="data_recebimento">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="destinatario">Destinatário </label>
                                            <input type="text" id="destinatario" name="destinatario"
                                                   class="form-control" placeholder="Informe o Distinatário">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="remetente">Remetente </label>
                                            <input type="text" id="remetente" name="remetente" class="form-control"
                                                   value=""
                                                   placeholder="Informe o Remetente">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="observacao">Observação</label>
                                            <textarea name="observacao" class="form-control" id="observacao" cols="30"
                                                      rows="4"></textarea>
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
                                        <a href="<?= url("/encomendas") ?>" class="btn btn-sm btn-danger">CANCELAR</a>
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
                                <h3 class="mb-0"><?= "Destinatário: {$encomenda->destinatario}" ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/encomenda/{$encomenda->id}") ?>" method="post">
                            <input type="hidden" name="acao" value="atualizar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">ID</label>
                                            <input type="text" id="input-username" class="form-control"
                                                   placeholder="0000"
                                                   value="<?= $encomenda->id ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="porteiro_recebeu">Recebido
                                                por: </label>
                                            <input type="text" id="porteiro_recebeu" class="form-control"
                                                   placeholder="Porteiro"
                                                   value="<?= "{$porteiro_recebeu->nome} {$porteiro_recebeu->sobrenome}" ?>"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="porteiro_entregou">Entregue
                                                por: </label>
                                            <input type="text" id="porteiro_entregou" class="form-control"
                                                   value="<?= $encomenda->porteiro_entregou == null ? "" : "{$porteiro_entregou->nome} {$porteiro_entregou->sobrenome}" ?>"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="morador_id">Morador</label>
                                            <select id="morador_id" name="morador_id" class="form-control select2">
                                                <?php
                                                $morador_id = $encomenda->morador_id;
                                                $select = function ($value) use ($morador_id) {
                                                    return ($morador_id == $value ? "selected" : null);
                                                }
                                                ?>
                                                <option value="">Selecione uma pessoa cadastrada</option>
                                                <?php if (isset($moradores)) {
                                                    foreach ($moradores as $morador): ?>
                                                        <option <?= $select($morador->id); ?>
                                                                value="<?= $morador->id ?>"><?= "{$morador->nome} {$morador->sobrenome} - " . buscarApto($morador->apartamento_id)?></option>
                                                    <?php endforeach;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="destinatario">Destinatário </label>
                                            <input type="text" id="destinatario"
                                                   name="destinatario" value="<?= $encomenda->destinatario ?>"
                                                   class="form-control" placeholder="Informe o Distinatário">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="remetente">Remetente </label>
                                            <input type="text" id="remetente" name="remetente" class="form-control"
                                                   value="<?= $encomenda->remetente ?>"
                                                   placeholder="Informe o Remetente">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_recebimento">Data de
                                                Recebimeto</label>
                                            <input class="form-control datetimepicker" name="data_recebimento"
                                                   type="datetime-local" disabled
                                                   value="<?= dateTime_fmt_front($encomenda->data_recebimento) ?>"
                                                   id="data_recebimento">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_entrega">Data de
                                                Entrega</label>
                                            <input class="form-control" type="datetime-local" name="data_entrega"
                                                   value="<?= dateTime_fmt_front($encomenda->data_entrega) ?>"
                                                <?= $encomenda->data_entrega == null ? "" : "disabled" ?>
                                                   id="data_entrega">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="observacao">Observação</label>
                                            <textarea name="observacao" class="form-control" id="observacao" cols="30"
                                                      rows="4"><?= $encomenda->observacao ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div>
                                    <button class="btn btn-sm btn-primary mb-2" style="width:90px;">SALVAR</button>
                                </div>
                                <div class="ml-2">
                                    <a href="<?= url('encomenda') ?>" class="btn btn-sm btn-success mb-2" style="width:90px;">NOVO</a>
                                </div>
                                <div class="ml-auto">
                                    <a href="<?= url('encomendas') ?>" class="btn btn-sm btn-warning mb-2" style="width:90px;">CANCELAR</a>
                                </div>
                                <div class="ml-2">
                                    <a href="#" class="btn btn-sm btn-danger" style="width:90px;"
                                       data-post="<?= url("/encomenda/{$encomenda->id}"); ?>"
                                       data-acao="delete"
                                       data-confirm="Tem certeza que deseja excluir está encomenda?"
                                       data-encomenda_id="<?= $encomenda->id; ?>">EXCLUIR</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
