<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/usuarios") ?>">Usuários</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="align-items-center">
                <div class="ajax_response"><?= flash(); ?></div>
            </div>
            <?php if (!isset($usuario)): ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">NOVO USUÁRIO</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/usuario") ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="acao" value="criar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nome">Nome*</label>
                                            <input type="text" id="nome" name="nome" class="form-control"
                                                   placeholder="Nome" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sobrenome">Sobrenome*</label>
                                            <input type="text" id="sobrenome" name="sobrenome" class="form-control"
                                                   placeholder="Sobrenome" required>
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
                                            <label class="form-control-label" for="senha">Senha*</label>
                                            <input type="password" id="senha" name="senha" class="form-control"
                                                   placeholder="Digite a senha" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Tipo de Usuário*</label>
                                            <select id="tipo" name="tipo" class="form-control">
                                                <option value="">Selecione tipo de acesso...</option>
                                                <option value="3">Sindico(a)</option>
                                                <option value="2">Porteiro(a)</option>
                                                <option value="1">Morador(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ativo">Status*</label>
                                            <select id="ativo" name="ativo" class="form-control">
                                                <option value="1">Ativo</option>
                                                <option value="2">Inativo</option>
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
                                        <a href="<?= url('usuarios') ?>" class="btn btn-sm btn-danger">CANCELAR</a>
                                    </div>
                                    <div class="col-9"></div>
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
                                <h2 class="mb-0"><?= $usuario->nomeCompleto() ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= url("/usuario/{$usuario->id}") ?>" method="post">
                            <input type="hidden" name="acao" value="atualizar">
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control"
                                                   placeholder="Nome" value="<?= $usuario->nome ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="sobrenome">Sobrenome</label>
                                            <input type="text" id="sobrenome" name="sobrenome" class="form-control"
                                                   placeholder="Sobrenome" value="<?= $usuario->sobrenome ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">Email </label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Email" value="<?= $usuario->email ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="senha">Senha </label>
                                            <input type="password" id="senha" name="senha" class="form-control"
                                                   placeholder="Digite a senha">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Acesso</label>
                                            <select id="tipo" name="tipo" class="form-control">
                                                <?php
                                                $tipo = $usuario->tipo;
                                                $select = function ($value) use ($tipo) {
                                                    return ($tipo == $value ? "selected" : "");
                                                };
                                                ?>
                                                <option <?=$select("SINDICO")?> value="3">Sindico(a)</option>
                                                <option <?=$select("PORTEIRO")?>  value="2">Porteiro(a)</option>
                                                <option <?=$select("MORADOR")?>  value="1">Morador(a)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="ativo"> Status </label>
                                            <select id="ativo" name="ativo" class="form-control">
                                                <?php
                                                $ativo = $usuario->ativo;
                                                $select = function ($value) use ($ativo) {
                                                    return ($ativo == $value ? "selected" : "");
                                                };
                                                ?>
                                                <option <?= $select("ATIVO") ?> value="1">Ativo</option>
                                                <option <?= $select("INATIVO") ?> value="2">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-1" >
                                        <button class="btn btn-sm btn-primary" style="width:90px;">SALVAR</button>
                                    </div>
                                    <div class="col-1 ml-4" >
                                        <a href="<?= url('usuario') ?>" class="btn btn-sm btn-success" style="width:90px;">NOVO</a>
                                    </div>
                                    <div class="col-1 ml-auto">
                                        <a href="<?= url('usuarios') ?>" class="btn btn-sm btn-danger" style="width:90px;">CANCELAR</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
