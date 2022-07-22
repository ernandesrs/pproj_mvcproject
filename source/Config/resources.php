<?php

if (!CONF_APP_LOCAL)
    return;

/**
 * 
 * este arquivo é responsável por copiar os arquivos .css e .js da pasta protegida de recursos
 * para pasta pública
 * 
 */

$sources = [
    /**
     * global
     */
    "public/assets/css" => [
        "node_modules/bootstrap-icons/font/bootstrap-icons.css"
    ],

    "public/assets/css/fonts" => [
        "node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff",
        "node_modules/bootstrap-icons/font/fonts/bootstrap-icons.woff2",
    ],

    "public/assets/js" => [
        "shared/scripts/global-scripts.js",
        "node_modules/jquery/dist/jquery.min.js",
        "node_modules/jquery-ui-dist/jquery-ui.min.js",
        "node_modules/bootstrap/dist/js/bootstrap.min.js",
        "node_modules/chart.js/dist/chart.min.js"
    ],

    /**
     * front
     */
    "public/assets/css/front" => [
        "shared/styles/front/custom.css",
    ],

    "public/assets/js/front" => [
        "shared/scripts/front/scripts.js",
    ],

    /**
     * dash
     */
    "public/assets/css/dash" => [
        "shared/styles/dash/custom.css",
        "shared/styles/dash/custom.dark.css",
    ],

    "public/assets/js/dash" => [
        "shared/scripts/dash/scripts.js",
    ],
];

foreach ($sources as $destiny => $resources) {
    foreach ($resources as $resource) {

        $fResourcePath = CONF_BASE_DIR . "/{$resource}";
        $fResourceDestiny = CONF_BASE_DIR . "/{$destiny}";

        if (file_exists($fResourcePath)) {
            if (!file_exists($fResourceDestiny))
                resources_cmDir($destiny);

            $resourceName = resources_grName($resource);

            copy($fResourcePath, $fResourceDestiny . "/{$resourceName}");
        }
    }
}

function resources_cmDir($destiny)
{
    $destinyArr = explode("/", $destiny);
    $ck = CONF_BASE_DIR;
    foreach ($destinyArr as $dest) {
        $ck .= "/{$dest}";
        if (!file_exists($ck))
            mkdir($ck);
    }
}

function resources_grName($resource)
{
    return array_reverse(explode("/", $resource))[0];
}
