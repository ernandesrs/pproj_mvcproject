<?= $v->layout("layouts/front") ?>

<?= $v->start("content") ?>

<div class="container">
    <h1 class="text-center">Um artigo do blog do site</h1>
    <hr>
    <p>Artigo: <?= $article ?></p>
</div>

<?= $v->end("content") ?>