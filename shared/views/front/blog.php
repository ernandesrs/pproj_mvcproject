<?= $v->layout("layouts/front") ?>

<?= $v->start("content") ?>

<div class="container">
    <h1 class="text-center">Blog do site</h1>
    <hr>
    <a href="<?= $router->route("front.blog.category", ["category" => "Categoria qualquer"]); ?>">Categoria</a>
    <hr>
    <a href="<?= $router->route("front.blog.article", ["article" => "Artigo qualquer"]); ?>">Artigo</a>
</div>

<?= $v->end("content") ?>