<?php

namespace App\Controllers\Dash;

use App\Controllers\Controller;
use App\Models\Auth;
use App\Models\User;
use Components\Router\Router;
use stdClass;

class DashController extends Controller
{
    /** @var stdClass */
    protected $settings;

    /** @var array */
    protected $allowedUsersLevels;

    /**
     * @param Router $router
     */
    public function __construct($router)
    {
        parent::__contruct($router);

        /**
         * 
         * Usuário logado
         * 
         */
        if (!$this->logged) {
            $router->redirect("auth.login");
            return;
        }

        /**
         * 
         * Níveis de usuários com acesso permitido
         * 
         */
        $this->allowedUsersLevels = [User::LEVEL_MASTER, User::LEVEL_ADMIN];

        if (!in_array($this->logged->level, $this->allowedUsersLevels)) {
            message()->default("OOPS! Você não possui permissão para acessar esta área!")->time()->flash();
            $router->redirect("front.front");
            return;
        }

        /**
         * 
         * Carrega configurações do usuário logado
         * 
         */
        $this->settings = $this->getSettings();

        /**
         * 
         * Torna dados disponíveis para as views
         * 
         */
        $this->view->addData([
            "dash_settings" => $this->settings
        ]);

        if (is_get_request())
            $this->logged->activityReport(["last_page" => $this->router->currentRoutePath(true)]);
    }

    /**
     * @return stdClass
     */
    protected function getSettings(): stdClass
    {
        $dashSettingsPath = CONF_BASE_DIR . "/storage/dash_settings.json";
        if (!file_exists($dashSettingsPath))
            file_put_contents($dashSettingsPath, json_encode([]));

        $dashSettings = (array) json_decode(file_get_contents($dashSettingsPath));

        if ($dashSettings[$this->logged->id] ?? null)
            return (object) $dashSettings[$this->logged->id];

        $defaultSettings[$this->logged->id] = [
            "theme" => (object) [
                "dark_mode" => false
            ],
            "listings" => (object) [
                "limit_items" => 12,
                "order_create_date" => "desc",
            ],
        ];

        file_put_contents($dashSettingsPath, json_encode($defaultSettings + $dashSettings));

        return (object) $defaultSettings[$this->logged->id];
    }
}
