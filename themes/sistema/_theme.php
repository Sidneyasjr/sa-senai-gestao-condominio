<?php

use Source\Models\Autenticacao;
$usuario = Autenticacao::usuario();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Cadastro de Funcionários - Gest Residents</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= theme("/assets/img/logo.png") ?>" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= theme("/assets/vendor/nucleo/css/nucleo.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= theme("/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css") ?>"
          type="text/css">
    <link rel="stylesheet" href="<?= theme("/assets/vendor/select2/dist/css/select2.min.css") ?>"
          type="text/css">
    <link rel="stylesheet" href="<?= theme("/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css") ?>"
          type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?= theme("/assets/css/argon.css") ?>" type="text/css">
</head>

<body>
<div>
</div>
<!-- Sidenav -->
<?= $v->insert("componentes/menu"); ?>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-default border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Inicio Foto no canto superior a direita do usuário-->
                <div class="col-sm-10"></div>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                </div>

                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">
                            <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?= theme("/assets/img/user.png") ?>">
                  </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?= "{$usuario->nome} {$usuario->sobrenome}"?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Bem vindo!</h6>
                            </div>
                            <a href="<?= url('/perfil') ?>" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>Meu Perfil</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= url('/sair') ?>" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Sair</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?= $v->section("content"); ?>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= theme("/assets/vendor/jquery/dist/jquery.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery/dist/jquery.mask.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery/dist/jquery.form.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery/dist/jquery-ui.js") ?>"></script>
<script src="<?= theme("/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/js-cookie/js.cookie.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/select2/dist/js/select2.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/datatables.net/js/jquery.dataTables.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js") ?>"></script>
<!-- Argon JS -->
<script src="<?= theme("/assets/js/argon.js?v=1.2.0") ?>"></script>
<script src="<?= theme("/assets/js/scripts.js") ?>"></script>
</body>

</html>

