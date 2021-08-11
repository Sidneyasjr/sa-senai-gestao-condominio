<?php $v->layout("_theme"); ?>
<div class="header pb-6 d-flex align-items-center" style="min-height: 110px;">
    <div class="container-fluid d-flex align-items-center">
        <div class="mt--7">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="<?= url("/home") ?>"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= url("/perfil") ?>">Perfil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar Perfil</li>
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
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0"><?= $usuario->nomeCompleto() ?></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= url("/edit-perfil") ?>" method="post">
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
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email </label>
                                        <input type="email" id="email" name="email" class="form-control"
                                               placeholder="Email" value="<?= $usuario->email ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="nascimento">Nascimento</label>
                                        <input type="date" id="nascimento" name="nascimento" class="form-control"
                                               placeholder="00/00/0000"
                                               value="<?= $usuario->nascimento ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="telefone">Telefone</label>
                                        <input type="text" id="telefone" name="telefone"
                                               class="form-control mask-tel"
                                               placeholder="(00) 00000-0000" value="<?= $usuario->telefone ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="senha">Senha</label>
                                        <input type="password" id="senha" name="senha" class="form-control"
                                               placeholder="Digite a senha">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="senha_confirme">Confirme a senha</label>
                                        <input type="password" id="senha_confirme" name="senha_confirme" class="form-control"
                                               placeholder="Confirme a senha">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-sm btn-primary" style="width:90px;">SALVAR</button>
                                </div>
                                <div class="col-1 ml-auto">
                                    <a href="<?= url('perfil') ?>" class="btn btn-sm btn-danger" style="width:90px;">CANCELAR</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
