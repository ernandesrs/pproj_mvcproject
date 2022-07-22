<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token() ?>" />

    <meta name="robots" content="<?= $seo->follow ?? null ?>">
    <title><?= ucwords(app_name()) . " | " . (!empty($seo->title) ? ("" . $seo->title) : null) ?></title>
    <meta name="description" content="<?= $seo->description ?? null ?>">
    <link rel="canonical" href="<?= $seo->url ?? null ?>" />
    <link rel="shortcut icon" href="<?= asset("favicon.ico") ?>" type="image/x-icon">

    <?php

    $styles = [
        "bootstrap-icons.css",
        "front/custom.css",
    ];

    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='" . asset("css/{$style}") . "'>\n";
    }

    ?>

    <?= $v->section("styles") ?>
</head>

<body>

    <header class="header">
        <div class="header-inner">
            <nav class="nav flex-column">
                <a class="nav-link active" href="<?= $router->route("front.index") ?>">
                    <i class="icon bi bi-house-fill"></i>
                    <span class="text">início</span>
                </a>
                <a class="nav-link" href="#skill">
                    <i class="icon bi bi-person-lines-fill"></i>
                    <span class="text">habilidades</span>
                </a>
                <a class="nav-link" href="#portfolio">
                    <i class="icon bi bi-briefcase-fill"></i>
                    <span class="text">portfólio</span>
                </a>
                <a class="nav-link" href="#contact">
                    <i class="icon bi bi-messenger"></i>
                    <span class="text">contato</span>
                </a>
            </nav>
        </div>
    </header>

    <main class="main">
        <?= $this->section("content") ?>
    </main>

    <?php

    $scripts = [
        "jquery.min.js",
        "jquery-ui.min.js",
        "bootstrap.min.js",
        "global-scripts.js",
        "front/scripts.js",
    ];

    foreach ($scripts as $script) {
        echo "<script src='" . asset("js/{$script}") . "'></script>\n";
    }

    ?>

    <?= $v->section("scripts") ?>

</body>

</html>