<?php

namespace App\Controllers;

use App\Models\Auth;
use Components\Router\Router;
use Components\Template\Template;
use Components\Uploader\Uploader;

class Controller
{
    /** @var Router */
    protected $router;

    /** @var Template */
    protected $view;

    /** @var Uploader */
    protected $uploader;

    /** @var User */
    protected $logged;

    /**
     * @param Router $router
     * @return void
     */
    public function __contruct(Router $router = null)
    {
        $this->router = $router;
        $this->view = new Template(CONF_BASE_DIR . CONF_VIEWS_DIR);
        $this->uploader = new Uploader(CONF_BASE_DIR . CONF_UPLOAD_BASE_DIR);

        /**
         * 
         * usuário logado
         * 
         */
        $this->logged = (new Auth())->logged();

        $this->view->addData([
            "router" => $this->router,
            "logged" => $this->logged
        ]);
    }

    /**
     * @param string $name
     * @param array $args
     * @return string|null
     */
    protected function route(string $name, array $args = []): ?string
    {
        return $this->router->route($name, $args);
    }

    /**
     * @param string $name
     * @param array $data
     * @return Template
     */
    protected function view(string $name, array $data = []): Template
    {
        return $this->view->addView($name)->addData($data);
    }

    /**
     * Verifica o CSRF_TOKEN
     * @param array $form
     * @return void|boolean em requisições ajax é dado retorno em JSON seguido por um exit na execução.
     * Em requisições não ajax é retornado true para token válido ou false para token não válido
     */
    protected function csrfVerify(array $form)
    {
        if (!csrf_token_verify($form)) {

            $message = message()->danger("Falha ao validar token de segurança. Atualize a página e tente de novo.", "TOKEN INVÁLIDO")->float();

            if (is_ajax_request()) {
                echo json_encode([
                    "success" => false,
                    "message" => $message->render()
                ]);
                exit;
            }

            $message->flash();

            return false;
        }

        return true;
    }

    /**
     * Verifica limite de requisições
     * @param string $name
     * @param integer $limit
     * @param integer $block_time
     * @return void|boolean em requisições ajax é dado retorno em JSON seguido por um exit na execução.
     * Em requisições não ajax é retornado true para limite atingido ou false caso contrário
     */
    protected function attemptLimit(string $name, int $limit = 3, int $block_time = 5)
    {
        if (attempt_limit($name, $limit, $block_time)) {

            $message = message()->danger("Limite de tentativas atingido! Tente de novo em alguns minutos.")->float();

            if (is_ajax_request()) {
                echo json_encode([
                    "success" => false,
                    "message" => $message->render()
                ]);
                exit;
            }

            $message->flash();

            return true;
        }

        return false;
    }
}
