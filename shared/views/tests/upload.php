<?= $v->layout("layouts/tests") ?>

<?= $v->start("styles") ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<?= $v->end("styles") ?>

<?= $v->start("content") ?>
<div class="container w-100">
    <div class="py-3">
        <h1>Testes da classe de upload</h1>
        <hr>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 pb-3">
            <?php
            $flash = (new \Components\Message\Message())->flash();
            if ($flash) {
                echo $flash->render();
            }
            ?>

        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <h4>Images</h4>
            <hr>
            <form action="<?= CONF_URL_BASE ?>/testes/uploads" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <button class="btn btn-sm btn-info">Enviar</button>
            </form>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <h4>Video</h4>
            <hr>
            <form action="<?= CONF_URL_BASE ?>/testes/uploads" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="file" name="video" id="video">
                </div>
                <button class="btn btn-sm btn-info">Enviar</button>
            </form>
        </div>

        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <h4>Files</h4>
            <hr>
            <form action="<?= CONF_URL_BASE ?>/testes/uploads" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="file" name="file" id="file">
                </div>
                <button class="btn btn-sm btn-info">Enviar</button>
            </form>
        </div>
    </div>
</div>
<?= $v->end("content") ?>

<?= $v->start("scripts") ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>

</script>
<?= $v->end("scripts") ?>