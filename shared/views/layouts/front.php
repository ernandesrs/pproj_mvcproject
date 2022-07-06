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
        "front/custom.css",
        "bootstrap-icons.css"
    ];

    foreach ($styles as $style) {
        echo "<link rel='stylesheet' href='" . asset("css/{$style}") . "'>\n";
    }

    ?>

    <?= $v->section("styles") ?>
</head>

<body>
    <header class="header">
        <div class="container"></div>
    </header>

    <main class="main">
        <div class="container">
            <div class="message-area mt-2">
                <?php if ($flash = message_flash()) {
                    echo $flash->render();
                } ?>
            </div>
        </div>

        <?= $v->section("content") ?>
    </main>

    <footer class="footer">
        <div class="container"></div>
    </footer>

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