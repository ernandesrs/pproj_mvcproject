<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section section-user-edit">
    <?php

    $headerButtons = [
        "phButtonOne" => [
            "type" => "link",
            "text" => "Voltar",
            "style" => "secondary",
            "link" => $router->route("dash.users"),
            "activeIcon" => icon_class("arrowLeft"),
            "altIcon" => icon_class("arrowLeft"),
        ]
    ];

    $filterFormActionLink = $router->route("dash.users.filter");

    include __DIR__ . "/includes/page-header.php";

    ?>

    <div class="section-content">
        <div class="row py-3">
            <div class="col-12 col-lg-4">
                <div class="photo <?= $user->photo ? "" : "no-photo" ?>">
                    <?= $user->photo ? "" : "<span>" . $user->first_name[0] . "</span>" ?>
                    <img class="rounded-circle img-thumbnail" src="<?= thumb_nm(storage_path($user->photo)) ?>" alt="<?= $user->username ?>">
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <form action="<?= $router->route("dash.users.update", ["id" => $user->id]) ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <?php
                        include __DIR__ . "/includes/users-form-fields.php";
                        ?>
                        <div class="col-12 form-group text-right mb-0">
                            <button class="btn btn-outline-danger <?= icon_class("userX") ?> jsConfirmationModalButton" data-action="<?= $router->route("dash.users.delete", ["id" => $user->id]) ?>" data-style="danger" data-message="Você está excluindo um usuário definitivamente e isso não pode ser desfeito, confirme para continuar.">
                                Excluir
                            </button>
                            <button class="btn btn-info <?= icon_class("userCheck") ?>" data-active-icon="<?= icon_class("userCheck") ?>" data-alt-icon="<?= icon_class("loading") ?>" type="submit">
                                Atualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $v->end("content") ?>


<?= $v->start("modals") ?>

<?php include __DIR__ . "/../includes/modal-confirmation.php" ?>

<?= $v->end("modals") ?>