<?= $v->layout("layouts/auth") ?>

<?= $v->start("content") ?>

<div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4 card card-body shadow-sm border-0">
    <h1 class="text-center">Login</h1>
    <div class="message-area">
        <?php if ($flash = message_flash()) {
            echo $flash->render();
        } ?>
    </div>
    <form action="<?= CONF_URL_BASE ?>/auth/authenticate" method="POST">
        <?= csrf_input() ?>

        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-control text-center" type="text" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input class="form-control text-center" type="password" name="password" id="password">
        </div>
        <div class="py-3 text-center">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
</div>

<?= $v->end("content") ?>