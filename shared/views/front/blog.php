<?= $v->layout("layouts/front") ?>

<?= $v->start("content") ?>

<div class="container">
    <h1 class="text-center">Blog do site</h1>
    <hr>
    <h2>Categorias</h2>
    <p>
        <a href="<?= $router->route("front.blog.category", ["category" => "tecnologia"]); ?>">Tecnologia</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.category", ["category" => "tecnologia", "page" => 2]); ?>">Tecnologia(Página 2)</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.category", ["category" => "tecnologia", "page" => 20]); ?>">Tecnologia(Página 20)</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.category", ["category" => "desktops-e-notebook"]); ?>">Desktops e notebook</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.category", ["category" => "novidades"]); ?>">Novidades</a>
    </p>
    <hr>
    <h2>Artigos</h2>
    <p>
        <a href="<?= $router->route("front.blog.article", ["article" => "slug-do-artigo-01"]); ?>">Artigo 01</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.article", ["article" => "slug-do-artigo-02"]); ?>">Artigo 02</a>
    </p>
    <p>
        <a href="<?= $router->route("front.blog.article", ["article" => "slug-do-artigo-03"]); ?>">Artigo 03</a>
    </p>
</div>

<?= $v->end("content") ?>