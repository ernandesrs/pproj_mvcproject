<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>" />
    <meta name="robots" content="<?= $seo->follow ?? null ?>">
    <title>Dashboard: <?= ("" . !empty($seo->title) ? ("" . $seo->title) : null) ?></title>
    <meta name="description" content="<?= $seo->description ?? null ?>">
    <link rel="canonical" href="<?= $seo->url ?? null ?>" />
    <link rel="shortcut icon" href="<?= asset("favicon.ico") ?>" type="image/x-icon">

    <?php

    $styles = [
        ($dash_settings->theme->dark_mode ? "dash/custom.dark.css" : "dash/custom.css"),
        "bootstrap-icons.css"
    ];

    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='" . asset("css/{$style}") . "'>\n";
    }

    ?>

    <?= $v->section("styles") ?>
</head>

<body>
    <aside class="d-none d-lg-block sidebar jsDashboardSidebar">
        <div class="container-fluid">
            <div class="profile d-flex align-items-center">
                <div class="photo <?= $logged->photo ? "" : "no-photo" ?>">
                    <?= $logged->photo ? "" : "<span>" . $logged->first_name[0] . "</span>" ?>
                    <img class="rounded-circle img-thumbnail" src="<?= thumb_nm(storage_path($logged->photo)) ?>" alt="<?= $logged->username ?>">
                </div>
                <div class="info pl-2 w-100">
                    <div class="mb-0 username"><?= $logged->username ?></div>
                    <div class="mb-0 d-flex">
                        <span class="level">
                            <small><?= get_term("user.levels.level_{$logged->level}") ?></small>
                        </span>
                        <a class="profile-link ml-auto" href="<?= $router->route("auth.logout") ?>">
                            <?= icon_elem("authLogout") ?> Sair
                        </a>
                    </div>
                </div>
            </div>

            <div class="sidebar-elements">
                <?php foreach (CONF_DASHBOARD_SIDEBAR as $key => $element) :
                    $element = (object) $element; ?>
                    <div class="element">
                        <h5 class="title"><?= $key ?></h5>
                        <ul class="nav flex-column">
                            <?php foreach ($element as $k => $el) :
                                $el = (object) $el;
                                $item = "
                                    <li class='nav-item'>
                                        <a class='nav-link " . (in_array($router->currentRouteName(), $el->activeIn) ? 'active' : null) . "' href='" . $router->route($el->routeName) . "' target='{$el->target}'>
                                            " . icon_elem($el->iconName) . " <span>{$el->text}</span>
                                        </a>
                                    </li>
                                "; ?>

                                <?php if (!($el->visible_to ?? null)) : ?>
                                    <?= $item ?>
                                <?php elseif (in_array($logged->level, $el->visible_to)) : ?>
                                    <?= $item ?>
                                <?php endif; ?>

                            <?php
                            endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </aside>

    <main class="main">
        <div class="container-fluid">
            <div class="main-bar d-flex align-items-center py-2">
                <button class="btn btn-sidebar-toggler jsSidebarToggler d-lg-none <?= icon_class("arrowRightSquare") ?>" data-active-icon="<?= icon_class("arrowRightSquare") ?>" data-alt-icon="<?= icon_class("arrowLeftSquare") ?>"></button>
                <div class="ml-1">
                    <button class="btn btn-sm btn-outline-secondary border-0 jsNotifications">
                        <?= icon_elem("bell") ?>
                    </button>
                </div>
                <div class="ml-auto">
                    <a class="btn btn-sm btn-outline-danger" href="<?= $router->route("auth.logout") ?>">
                        <?= icon_elem("authLogout") ?> Sair
                    </a>
                </div>
            </div>

            <div class="message-area mt-2">
                <?php if ($flash = message_flash()) {
                    echo $flash->render();
                } ?>
            </div>

            <?= $v->section("content") ?>
        </div>
    </main>

    <?php

    $scripts = [
        "jquery.min.js",
        "jquery-ui.min.js",
        "bootstrap.min.js",
        "global-scripts.js",
        "dash/scripts.js",
    ];

    foreach ($scripts as $script) {
        echo "<script src='" . asset("js/{$script}") . "'></script>\n";
    }

    ?>

    <?= $v->section("modals") ?>

    <?= $v->section("scripts") ?>
    <script>
        let urlDash = "<?= $router->route("dash.dash") ?>";

        // dash get updated data
        setInterval(function() {
            dashData();
        }, 30000);

        function dashData() {
            $.post(urlDash, function(response) {
                let reportsTable = $(".jsReportsTable");

                if (response.reports) {
                    $.each(response.reports, function(k, v) {
                        let reportLine = reportsTable.find("#report" + v.id);
                        reportLine.find(".last-report").html(v.last_report);
                        reportLine.find(".last-page a").html(v.last_page_name).attr("href", v.last_page);
                    });
                }
            }, "json");
        }
    </script>
</body>

</html>