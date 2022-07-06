<?= $v->layout("layouts/tests") ?>

<?= $v->start("styles") ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<style>
    .alert-float {
        width: 100%;
        max-width: 375px;
        position: fixed;
        right: 20px;
        top: 20px;
        z-index: 100;
        box-shadow: 0 0 12px -2px rgb(0, 0, 0, 0.35);
    }
</style>
<?= $v->end("styles") ?>

<?= $v->start("content") ?>
<div class="container w-100">
    <div class="py-3">
        <h1>Testes da classe de mensagens</h1>
        <hr>
    </div>

    <div>
        <?= $messages->float ?>
        <?= $messages->wtimer ?>
        <?= $messages->wotimer ?>
        <?php
        $flash = (new \Components\Message\Message)->flash();
        $flash->time(4);
        if ($flash)
            echo $flash->render();
        ?>
        <?= $messages->json ?>
    </div>
</div>
<?= $v->end("content") ?>

<?= $v->start("scripts") ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $.each($(".alert"), function(ki, vi) {
        if ($(vi).attr("data-timer")) {
            initTimer($(vi));
        }
    });

    function initTimer(jqObj) {
        let time = parseFloat(jqObj.attr("data-timer"));

        setTimeout(function() {
            jqObj.fadeOut(500, function() {
                $(this).remove();
            });
        }, time * 1000);
    }
</script>
<?= $v->end("scripts") ?>