<?php $v->layout("_web"); ?>
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
                <p class="h1 text-center text-danger">&bull;<?= $error->code; ?>&bull;</p>
                <h1><?= $error->title; ?></h1>
                <p><?= $error->message; ?></p>
                <?php if ($error->link): ?>
                    <a class="btn btn-block btn-default"
                       title="<?= $error->linkTitle; ?>" href="<?= $error->link; ?>"><?= $error->linkTitle; ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

