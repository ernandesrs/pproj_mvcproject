<?= $v->layout("layouts/front") ?>

<?= $v->start("content") ?>

<div class="container">
    <h1 class="text-center">Artigos para esta categoria do blog</h1>
    <hr>
    <?php if ($category) : ?>
        <p>
            Você está na categoria: <b><?= $category ?></b>
        </p>
    <?php endif; ?>

    <?php if ($page) : ?>
        <p>
            Você está na página: <b><?= $page ?></b>
        </p>
    <?php endif; ?>
</div>

<?= $v->end("content") ?>