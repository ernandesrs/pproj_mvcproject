<?php

namespace App\Controllers\Api;

class IndexController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function index(): void
    {
        $data = [
            "success" => true,
            "ping" => "pong",
        ];

	$this->response($data);

        return;
    }

    /**
     * @return void
     */
    public function sayMyName(): void
    {
        $yourName = filter_input(INPUT_POST, "name") ?? "Not Informed :(";

        $data = [
            "success" => true,
            "yourname" => $yourName,
        ];

	$this->response($data);

        return;
    }
}
