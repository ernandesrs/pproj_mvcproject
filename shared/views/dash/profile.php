<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section section-profile">
    <div class="d-flex flex-column align-items-center">
        <div class="jumbotron jumbotron-fluid w-100 py-5 text-center">
            <div class="container py-1">
                <div>
                    <h1 class="display-4">
                        <?= $logged->username ?>
                    </h1>
                    <p class="lead">
                        Bem vindo <strong><?= $logged->first_name . " " . $logged->last_name ?></strong>!
                    </p>
                </div>
                <div>
                    <div class="photo <?= $logged->photo ? "" : "no-photo" ?>">
                        <?= $logged->photo ? "" : "<span>" . $logged->first_name[0] . "</span>" ?>
                        <img class="rounded-circle img-thumbnail" src="<?= thumb_nm(storage_path($logged->photo)) ?>" alt="<?= $logged->username ?>">
                    </div>
                </div>
                <div class="pt-4">
                    <a class="btn btn-outline-dark-light" href="<?= $router->route("dash.dash") ?>">
                        <?= icon_elem("pieChart") ?> Dashboard
                    </a>
                    <a class="btn btn-outline-dark-light" href="<?= $router->route("dash.users.edit", ["id" => $logged->id]) ?>">
                        <?= icon_elem("pencilSquare") ?> Editar meus dados
                    </a>
                    <a class="btn btn-outline-danger" href="<?= $router->route("auth.logout") ?>">
                        <?= icon_elem("authLogout") ?> Sair
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $v->end("content") ?>