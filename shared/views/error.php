<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERRO <?= $errorCode ?? 404 ?>!</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 text-center">
            <h1 class="font-weight-bold">ERRO <?= $errorCode ?? 404 ?></h1>
            <?php if (($errorCode ?? 404) == 404) : ?>
                <p class="h4 font-weight-normal py-2">
                    A página que você está procurando foi movida, renomeada, excluída ou talvez não existe.
                </p>
            <?php else : ?>
                <p class="h4 font-weight-normal py-2">
                    Houve um erro interno ao tentar acessar esta página.
                </p>
            <?php endif; ?>
            <div class="py-2 text-center">
                <span class="mr-2">Voltar para a</span> <a class="btn btn-lg btn-primary" href="<?= CONF_URL_BASE ?>">PÁGINA INICIAL</a>
            </div>
        </div>
    </div>
</body>

</html>