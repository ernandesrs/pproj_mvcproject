<?php

namespace Components\Router;

use Exception;

class Router extends Route
{
    /**
     * @param string $urlBase
     */
    public function __construct(string $urlBase)
    {
        $this->urlBase = $urlBase;
    }

    /**
     * @param string $namespace
     * @return Router
     */
    public function namespace(string $namespace): Router
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @param string $url
     * @param string $action
     * @param string $name
     * @return Router
     */
    public function get(string $url, string $action, string $name): Router
    {
        $this->set(self::GET_METHOD, $url, $action, $name);
        return $this;
    }

    /**
     * @param string $url
     * @param string $action
     * @param string $name
     * @return Router
     */
    public function post(string $url, string $action, string $name): Router
    {
        $this->set(self::POST_METHOD, $url, $action, $name);
        return $this;
    }

    /**
     * @param string $method
     * @param string $url
     * @param string $action
     * @param string $name
     * @return bool
     */
    protected function set(string $method, string $url, string $action, string $name): bool
    {
        if (count(explode("@", $action)) != 2) {
            throw new Exception("Ao definir a rota, o parâmetro 'action' precisa seguir o padrão 'class@method'");
            return false;
        }

        /**
         * 
         * obtendo parâmetros
         * definindo variáveis para os parâmetros na url
         * 
         */
        $params = [];
        $urlArr = explode("/", $url);
        for ($i = count($urlArr) - 1; $i >= 0; $i--) {
            if (strpos($urlArr[$i], "{") !== false && strpos($urlArr[$i], "}") !== false) {
                $params[str_replace(["{", "}"], "", $urlArr[$i])] = null;
                $urlArr[$i] = "{var}";
            }
        }

        $url = implode("/", $urlArr);

        $this->routes[$method][$url] = [
            "namespace" => $this->namespace,
            "url" => $url,
            "action" => $action,
            "name" => $name,
            "params" => $params
        ];

        return true;
    }
}
