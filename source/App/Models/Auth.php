<?php

namespace App\Models;

use Components\Session\Session;

class Auth
{
    /**
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function authenticate(string $email, string $password): bool
    {
        $user = (new User())->find("email=:email", "email={$email}")->get();
        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user->password)) {
            return false;
        }

        $session = new Session();
        $session->add("logged_user", $user->id);

        return true;
    }

    /**
     * @return boolean
     */
    public function logout(): bool
    {
        (new Session())->remove("logged_user");
        return true;
    }

    /**
     * Obtém usuário logado
     * @return User|null
     */
    public function logged(): ?User
    {
        $session = new Session();
        $id = $session->get("logged_user");

        if (!$id) return null;

        $user = (new User())->find("id=:id", "id={$id}");
        if ($user->count() === 0) {
            $session->remove("logged_user");
            return null;
        }

        return $user->get();
    }

    /**
     * Verifica se usuário está logado e se existe na base dados
     * @return boolean
     */
    public function isLogged(): bool
    {
        $session = new Session();
        $id = $session->get("logged_user");

        if (!$id) return false;

        return (new User())->find("id=:id", "id={$id}")->count() === 0 ? false : true;
    }
}
