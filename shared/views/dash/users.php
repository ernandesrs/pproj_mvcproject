<?= $v->layout("layouts/dash") ?>

<?= $v->start("content") ?>

<div class="section section-users">
    <?php

    $headerButtons = [
        "phButtonOne" => [
            "type" => "link",
            "text" => "Novo usuário",
            "style" => "success",
            "link" => $router->route("dash.users.create"),
            "activeIcon" => icon_class("plusLg"),
            "altIcon" => icon_class("loading"),
        ]
    ];

    $filterFormActionLink = $router->route("dash.users.filter");

    include __DIR__ . "/includes/page-header.php";

    ?>

    <div class="section-content">
        <div class="row justify-content-start list-items">
            <?php if (!$users) : ?>
                <?php include __DIR__ . "/includes/alert-empty-list.php" ?>
                <?php else :
                foreach ($users as $user) : ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card card-body border-0 d-flex flex-column justify-content-center align-items-center list-item user">
                            <div class="photo <?= $user->photo ? "" : "no-photo" ?>">
                                <?= $user->photo ? "" : "<span>" . $user->first_name[0] . "</span>" ?>
                                <img class="rounded-circle img-thumbnail" src="<?= thumb_nm(storage_path($user->photo)) ?>" alt="<?= $user->username ?>">
                            </div>
                            <div class="text-center pt-2 pb-3">
                                <p class="mb-0 h2 username"><?= $user->username ?></p>
                                <p class="mb-0 h5 fullname"><?= $user->first_name . " " . $user->last_name ?></p>
                                <p class="mb-0 h5 email"><?= $user->email ?></p>
                            </div>
                            <a class="btn btn-info" href="<?= $router->route("dash.users.edit", ["id" => $user->id]) ?>">
                                <?= icon_elem("pencilSquare") ?> Editar
                            </a>
                        </div>
                    </div>
            <?php endforeach;
            endif; ?>
        </div>
    </div>

    <div class="section-footer pt-3">
        <!-- pagination -->
        <?php include __DIR__ . "/includes/pagination.php" ?>
    </div>
</div>


<?= $v->end("content") ?>