<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex,nofollow">
    <title><?= ucfirst(CONF_APP_NAME) ?> - <?= $seo->title ?? null ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            width: 100vw;
            min-height: 100vh;
        }

        .main-wrap {
            min-height: 100vh;
        }
    </style>
    <?= $v->section("styles") ?>
</head>

<body class="bg-light">

    <div class="main-wrap d-flex justify-content-center align-items-center">
        <div class="container row justify-content-center align-items-center">
            <?= $v->section("content") ?>
        </div>
    </div>

    <?= $v->section("scripts") ?>
</body>

</html>