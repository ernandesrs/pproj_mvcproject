<?php

namespace App\Controllers\Front;

class BlogController extends FrontController
{
    /**
     * @param [type] $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @return void
     */
    public function index(): void
    {
        // $v = $this->router->route("front.blog.category", ["category" => "tecnologia"]);
        // $v = $this->router->route("front.blog.category", ["category" => "tecnologia", "page" => 2, "origin" => "/jujubas/pebas"]);
        // $v = $this->router->route("front.blog.category", ["category" => "tecnologia", "page" => 2, "opa" => "KKK", "origin" => "/jujubas/pebas", "mais" => "um"]);
        // var_dump($v);
        // die;
        $this->view("front/blog")
            ->seo("Lista de artigos", "Lista de artigos do site", $this->route("front.blog.index"))
            ->render();
        return;
    }

    /**
     * @return void
     */
    public function category(): void
    {
        $page = !empty($_GET["page"]) ? $_GET["page"] : null;
        $category = !empty($_GET["category"]) ? $_GET["category"] : null;

        $this->view("front/blog-category", [
            "page" => $page,
            "category" => $category
        ])->seo("Lista de artigos na categoria", "Lista de artigos do site para esta categoria", $this->route("front.blog.category"))
            ->render();
        return;
    }

    /**
     * @return void
     */
    public function article(): void
    {
        $this->view("front/blog-article", [
            "article" => !empty($_GET["article"]) ? $_GET["article"] : null
        ])->seo("Artigo do blog", "Artigo do blog deste site", $this->route("front.blog.article"))
            ->render();
        return;
    }
}
