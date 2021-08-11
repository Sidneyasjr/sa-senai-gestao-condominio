<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Seja bem vindo - Gest Residents</title>
    <!-- Favicon -->
    <link rel="icon" href="<?= theme("/assets/img/logo.png") ?>" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="<?= theme("/assets/vendor/nucleo/css/nucleo.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= theme("/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css") ?>"
          type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?= theme("/assets/css/jquery-ui.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= theme("/assets/css/argon.css") ?>" type="text/css">
</head>

<body>
<!-- Header -->
<div class="header bg-danger py-7 py-lg-8 pt-lg-8">
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
             xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
<!-- Page content -->
<div class="container mt--8 pb-5">
    <?= $v->section("content"); ?>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="<?= theme("/assets/vendor/jquery/dist/jquery.min.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery/dist/jquery.form.js") ?>"></script>
<script src="<?= theme("/assets/vendor/jquery/dist/jquery-ui.js") ?>"></script>
<script src="<?= theme("/assets/js/login.js") ?>"></script>
</body>

</html>



