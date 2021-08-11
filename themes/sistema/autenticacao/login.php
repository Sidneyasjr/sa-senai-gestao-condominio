<?php $v->layout("_web"); ?>
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
                <img src="<?= theme("/assets/img/logo.png") ?>" alt="Logo do Sistema" width="150px"
                     class="rounded mx-auto d-block">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted">
                    <h1><small class="text-danger">Bem Vindo!</small></h1>
                    <p>Informe seus dados cadastrais</p>
                </div>
                <div class="text-center mb-2" hidden>
                    <small><a href="<?= url('registro') ?>" class="text-danger">Clique aqui</a> para um novo cadastro</small>
                </div>
                <div class="ajax_response"><?= flash(); ?></div>
                <form action="<?= url('/'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_input(); ?>
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control" name="email" autocomplete="false" value="" placeholder="Email"
                                   type="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control" name="senha" value="" placeholder="Senha" type="password">
                        </div>
                    </div>
                    <div>
                        <a target="_blank"
                           class="text-gray"
                           href="https://api.whatsapp.com/send?phone=5547991158947&text=Olá, preciso de ajuda com o login."
                        ><i class="fab fa-whatsapp"></i> WhatsApp: (47) 99115 8947</a>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-danger my-4">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



