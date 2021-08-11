<?php $v->layout("_web"); ?>
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-7">
            <div class="card bg-secondary border-0 mb-0">
                <div class="card-header bg-transparent pb-5">
                    <img src="<?= theme("/assets/img/logo.png") ?>" alt="Logo do Sistema" width="150px"
                         class="rounded mx-auto d-block">
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center text-muted mb-4">
                        <h1><small class="text-danger">Cadastre-se!</small></h1>
                    </div>
                    <form action="<?= url('/registro') ?>" method="post" enctype="multipart/form-data">
                        <div class="ajax_response"><?= flash(); ?></div>
                        <?= csrf_input(); ?>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="Nome" name="nome" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                </div>
                                <input class="form-control" placeholder="sobrenome" name="sobrenome" type="text">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control" placeholder="Email" name="email" type="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Senha" name="senha" type="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="Confirme a sua Senha" name="senha_confirme"
                                       type="password">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-danger my-4">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
