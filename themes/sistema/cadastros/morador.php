<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/moradores") ?>">Moradores</a></li>
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
            <?php if (!isset($morador)): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Novo Morador</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/morador") ?>" method="post">
                            <input type="hidden" name="acao" value="criar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nome">Nome*</label>
                                            <input type="text" id="nome" name="nome" class="form-control"
                                                   placeholder="Nome" required
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sobrenome">Sobrenome*</label>
                                            <input type="text" id="sobrenome" name="sobrenome" class="form-control"
                                                   placeholder="Nome" required
                                                   value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="id">ID</label>
                                            <input type="text" id="id" name="id" class="form-control" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="documento">CPF*</label>
                                            <input type="text" id="documento" name="documento"
                                                   class="form-control mask-doc" required
                                                   placeholder="000.000.000-00" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nascimento">Nascimento*</label>
                                            <input type="date" id="nascimento" name="nascimento" class="form-control"
                                                   placeholder="00/00/0000" required  value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="telefone">Telefone*</label>
                                            <input type="text" id="telefone" name="telefone"
                                                   class="form-control mask-tel" required
                                                   placeholder="(00) 00000-0000" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email*</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="apartamento">Apartamento</label>
                                            <input type="email" id="apartamento" name="apartamento" class="form-control"
                                                   disabled value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_entrada">Data de
                                                Entrada</label>
                                            <input class="form-control" type="date" name="data_entrada"
                                                   id="data_entrada">
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
                                        <a href="<?= url("/moradores") ?>" class="btn btn-sm btn-danger">CANCELAR</a>
                                    </div>
                                    <div class="col-9"></div>
                                    <div class="col-1 text-right">
                                        <a href="#!" class="btn btn-sm btn-dark">EXCLUIR</a>
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
                                <h3 class="mb-0"><?= $morador->nomeCompleto() . " - " . $morador->apartamento() ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/morador/{$morador->id}") ?>" method="post">
                            <input type="hidden" name="acao" value="atualizar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control"
                                                   placeholder="Nome"
                                                   value="<?= $morador->nome ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sobrenome">Sobrenome</label>
                                            <input type="text" id="sobrenome" name="sobrenome" class="form-control"
                                                   placeholder="Sobrenome" value="<?= $morador->sobrenome ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="id">ID</label>
                                            <input type="text" id="id" name="id" class="form-control"
                                                   value="<?= $morador->id ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="documento">CPF</label>
                                            <input type="text" id="documento" name="documento"
                                                   class="form-control mask-doc"
                                                   placeholder="000.000.000-00" value="<?= $morador->documento ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nascimento">Nascimento</label>
                                            <input type="date" id="nascimento" name="nascimento" class="form-control"
                                                   placeholder="00/00/0000"
                                                   value="<?= $morador->nascimento ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="telefone">Telefone</label>
                                            <input type="text" id="telefone" name="telefone"
                                                   class="form-control mask-tel"
                                                   placeholder="(00) 00000-0000" value="<?= $morador->telefone ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email </label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Email" value="<?= $morador->email ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="apartamento">Apartamento </label>
                                            <input type="email" id="apartamento" name="apartamento" class="form-control"
                                                   disabled value="<?= $morador->apartamento() ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_entrada">Data de
                                                Entrada</label>
                                            <input class="form-control" type="date" name="data_entrada"
                                                   id="data_entrada"
                                                   value="<?= $morador->data_entrada ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="data_saida">Data de Saída</label>
                                            <input class="form-control" type="date" name="data_saida" id="data_saida"
                                                   value="<?= $morador->data_saida ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div>
                                    <button class="btn btn-sm btn-primary mb-2" style="width:90px;">SALVAR</button>
                                </div>
                                <div class="ml-2">
                                    <a href="<?= url('morador') ?>" class="btn btn-sm btn-success mb-2"
                                       style="width:90px;">NOVO</a>
                                </div>
                                <div class="ml-auto">
                                    <a href="<?= url('moradores') ?>" class="btn btn-sm btn-warning mb-2"
                                       style="width:90px;">CANCELAR</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

