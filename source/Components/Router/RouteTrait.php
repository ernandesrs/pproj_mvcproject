<?php

namespace Components\Router;

trait RouteTrait
{
    /**
     * @return string
     */
    public function currentRouteName(): string
    {
        return $this->currentRoute["name"];
    }

    /**
     * @return string
     */
    public function currentRouteAction(): string
    {
        return $this->currentRoute["action"];
    }

    /**
     * @return string
     */
    public function currentRoutePath(bool $wparams = false): string
    {
        $params = [];
        if ($wparams) {
            $params = $_GET ?? [];
            unset($params["route"]);
        }

        return $this->currentRoute["url"] . (empty($params) ? null : ("?" . http_build_query($params)));
    }
}
