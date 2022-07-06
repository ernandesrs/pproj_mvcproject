<?php

namespace App\Controllers\Front;

class IndexController extends FrontController
{
    /**
     * @param $router
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
        $this->view("front/index")->seo("Bem vindo ao front do site")->render();
    }

    /**
     * @return void
     */
    public function error(): void
    {
        $this->view("error", ["errorCode" => filter_input(INPUT_GET, "err", FILTER_VALIDATE_INT) ?? 404])
            ->render();
    }
}
