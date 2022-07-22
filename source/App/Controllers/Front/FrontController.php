<?php

namespace App\Controllers\Front;

use App\Controllers\Controller;
use App\Models\User;

class FrontController extends Controller
{
    public function __construct($router)
    {
        // $user = new User();
        // $user->set([
        //     "first_name" => "Ernandes",
        //     "last_name" => "Ernandes",
        //     "username" => "Ernandes",
        //     "email" => "ernandesrsouza@gmail.com",
        //     "level" => 9,
        //     "gender" => "m",
        //     "password" => "ernandes",
        //     "password_confirm" => "ernandes",
        // ]);
        // $user->save();
        parent::__contruct($router);
    }
}
