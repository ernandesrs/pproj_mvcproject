<?php

namespace App\Controllers\Dash;

use App\Helpers\Date;
use App\Models\Product;
use App\Models\User;

class IndexController extends DashController
{
    /**
     * @param \Components\Router\Router $router
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
        $this->router->redirect("dash.dash");
        return;
    }

    /**
     * @return void
     */
    public function dash(): void
    {
        $reports = (new User())->find("level>:level", "level=1")->get(true);

        if (is_post_request()) {
            $data = [
                "reports" => ($reports ?? null) ? array_map(function ($item) {
                    $activity = $item->lastActivityReport()->data();

                    if ($activity) {
                        unset($activity->users_id, $activity->created_at, $activity->updated_at);
                        $activity->last_report = Date::hoursElapsedSoFar($activity->last_report);
                        $activity->last_page_name = $activity->last_page;
                        $activity->last_page = url($activity->last_page);
                    }

                    return $activity;
                }, $reports) : null
            ];

            echo json_encode($data);
            return;
        }

        $overviewBoxes = [
            "users" => (object) [
                "total" => (new User())->find()->count(),
                "text" => "Usuários",
                "icon" => icon_class("userGroup"),
                "link" => $this->route("dash.users"),
            ],
            "products" => (object) [
                "total" => (new Product())->find()->count(),
                "text" => "Produtos",
                "icon" => icon_class("box2"),
                "link" => $this->route("dash.products")
            ],
            "lorem1" => (object) [
                "total" => 0,
                "text" => "Lorem 1",
                "icon" => icon_class("bell"),
                "link" => ""
            ],
            "lorem2" => (object) [
                "total" => 0,
                "text" => "Lorem 2",
                "icon" => icon_class("sliders"),
                "link" => ""
            ],
        ];

        $this->view("dash/index", [
            "overviewBoxes" => $overviewBoxes,
            "reports" => $reports ?? null
        ])->seo("Resumo geral do sistema")->render();
    }

    /**
     * @return void
     */
    public function settings(): void
    {
        $apply = filter_input(INPUT_GET, "apply", FILTER_VALIDATE_BOOLEAN) ?? null;

        if ($apply) {
            $id = $this->logged->id;

            $darkMode = filter_input(INPUT_POST, "dark_mode");
            $limitItems = filter_input(INPUT_POST, "limit_items", FILTER_VALIDATE_INT);
            $orderCreateDate = filter_input(INPUT_POST, "order_create_date");

            $this->settings->theme->dark_mode = $darkMode == "on" ? true : false;

            $this->settings->listings->limit_items = ($limitItems ?? 12) < 1 ? 1 : $limitItems;
            $this->settings->listings->order_create_date = in_array($orderCreateDate, ["asc", "desc"]) ? $orderCreateDate : "asc";
            $dashSettings = json_decode(file_get_contents(CONF_BASE_DIR . "/storage/dash_settings.json"));
            $dashSettings->$id = $this->settings;

            file_put_contents(CONF_BASE_DIR . "/storage/dash_settings.json", json_encode($dashSettings));

            message()->info("Configurações atualizadas com sucesso.")->float()->flash();
            echo json_encode([
                "success" => true,
                "reload" => true
            ]);

            return;
        }

        $this->view("dash/settings", [
            "dash_settings" => $this->settings
        ])->seo("Configurações")->render();
    }

    /**
     * @return void
     */
    public function profile()
    {
        $this->view("dash/profile")->seo("Meu perfil")->render();
    }
}
