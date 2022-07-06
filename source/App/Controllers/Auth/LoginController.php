<?php

namespace App\Controllers\Auth;

use App\Models\Auth;

class LoginController extends AuthController
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
    public function login(): void
    {
        if ((new Auth())->isLogged())
            $this->router->redirect("dash.dash");

        $this->view("auth/login")->seo("Login")->render();
        return;
    }

    /**
     * @return void
     */
    public function authenticate(): void
    {
        if ((new Auth())->isLogged())
            $this->router->redirect("dash.dash");

        if (!$this->csrfVerify($_POST))
            $this->router->redirect("auth.login");

        if ($this->attemptLimit("logincontroller.authenticate", 3, 5))
            $this->router->redirect("auth.login");

        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

        if (!$email || !$password) {
            message()->warning("Informe todos os campos e tente de novo.")->flash();
            $this->router->redirect("auth.login");
        }

        if (!(new Auth())->authenticate($email, $password)) {
            message()->warning("Email e/ou senha inválios.")->flash();
            $this->router->redirect("auth.login");
        }

        message()->success("Pronto, agora você está logado.")->time(7.5)->flash();
        $this->router->redirect("dash.dash");

        return;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        $auth = new Auth();
        if ($auth->isLogged()) {
            message()->warning("Pronto, agora você não está mais logado.")->flash();
            $auth->logout();
        } else {
            message()->warning("Você não está logado.")->flash();
        }

        $this->router->redirect("auth.login");
        return;
    }
}
