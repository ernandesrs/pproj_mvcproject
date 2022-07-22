<?php

session_start();

$env = parse_ini_file(__DIR__ . "/../../.env");

date_default_timezone_set($env["APP_TIMEZONE"] ?? "America/Sao_Paulo");

$iconsPath = __DIR__ . "/../../shared/others/icons.json";
$icons = json_decode(file_exists($iconsPath) ? file_get_contents($iconsPath) : "");

define("CONF_APP_LOCAL", $env["APP_LOCAL"] ?? true);
define("CONF_APP_NAME", $env["APP_NAME"] ?? null);
define("CONF_URL_BASE", $env["APP_URL_BASE"] ?? null);
define("CONF_ICONS", (array) $icons);

define("CONF_DBASE_NAME", $env["DBASE_NAME"]);
define("CONF_DBASE_HOST", $env["DBASE_HOST"]);
define("CONF_DBASE_PORT", $env["DBASE_PORT"]);
define("CONF_DBASE_USER", $env["DBASE_USER"]);
define("CONF_DBASE_PASS", $env["DBASE_PASS"]);
define("CONF_DBASE_OPTIONS", [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_CASE => PDO::CASE_NATURAL
]);

define("CONF_BASE_DIR", __DIR__ . "/../..");

define("CONF_VIEWS_DIR", "/shared/views");

define("CONF_ASSETS_DIR", "/public/assets");

define("CONF_UPLOAD_BASE_DIR", "/storage/uploads");
define("CONF_UPLOAD_IMAGES_DIR", "images");
define("CONF_UPLOAD_MEDIAS_DIR", "medias");
define("CONF_UPLOAD_FILES_DIR", "files");

/**
 * DASHBOARD: menus do sidebar
 */
define("CONF_DASHBOARD_SIDEBAR", [
    "menu" => [
        [
            "text" => "Resumo geral",
            "routeName" => "dash.dash",
            "iconName" => "pieChart",
            "target" => "_self",
            "activeIn" => [
                "dash.dash"
            ],
        ],
        [
            "text" => "Produtos",
            "routeName" => "dash.products",
            "iconName" => "box2",
            "target" => "_self",
            "activeIn" => [
                "dash.products",
                "dash.products.create",
                "dash.products.edit",
            ]
        ],
        [
            "text" => "Usuários",
            "routeName" => "dash.users",
            "iconName" => "userGroup",
            "target" => "_self",
            "activeIn" => [
                "dash.users",
                "dash.users.create",
                "dash.users.edit",
            ],

            // Níveis dos usuários para os quais este item será visível
            "visible_to" => [
                App\Models\User::LEVEL_MASTER,
                App\Models\User::LEVEL_ADMIN
            ]
        ],
    ],
    "outros" => [
        [
            "text" => "Configurações",
            "routeName" => "dash.settings",
            "iconName" => "sliders",
            "target" => "_self",
            "activeIn" => [
                "dash.settings"
            ]
        ],
        [
            "text" => "Perfil",
            "routeName" => "dash.profile",
            "iconName" => "userProfile",
            "target" => "_self",
            "activeIn" => [
                "dash.profile"
            ]
        ],
        [
            "text" => "Sair",
            "routeName" => "auth.logout",
            "iconName" => "authLogout",
            "target" => "_self",
            "activeIn" => [
                "auth.logout"
            ]
        ],
    ]
]);


define("CONF_TERMS", [
    "user" => [
        "levels" => [
            "level_1" => "Comum",
            "level_2" => "",
            "level_3" => "",
            "level_4" => "",
            "level_5" => "",
            "level_7" => "Colaborador",
            "level_8" => "Administrador",
            "level_9" => "Proprietário",
        ],
        "genders" => [
            "gender_m" => "Masculino",
            "gender_f" => "Feminino",
        ],
    ],

    "product" => [
        "purchase_mode" => [
            "purchase_1" => "Unidade",
            "purchase_2" => "Pacote",
            "purchase_3" => "Grupo de pacotes",
        ],
        "sale_mode" => [
            "sale_1" => "Unidade",
            "sale_2" => "Pacote",
            "sale_3" => "Grupo de pacotes",
        ],
    ]
]);
