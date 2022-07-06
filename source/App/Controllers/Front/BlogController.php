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
        $this->view("front/blog-category")
            ->seo("Lista de artigos na categoria", "Lista de artigos do site para esta categoria", $this->route("front.blog.category"))
            ->render();
        return;
    }

    /**
     * @return void
     */
    public function article(): void
    {
        $this->view("front/blog-article")
            ->seo("Artigo do blog", "Artigo do blog deste site", $this->route("front.blog.article"))
            ->render();
        return;
    }
}
