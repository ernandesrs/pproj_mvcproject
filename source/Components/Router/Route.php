<?php

namespace Components\Router;

use Exception;

abstract class Route
{
    use RouteTrait;

    protected const GET_METHOD = "GET";
    protected const POST_METHOD = "POST";
    protected const NOTFOUND = 404;
    protected const UNAUTHORIZED = 401;
    protected const FORBIDDEN = 403;
    protected const NOTIMPLEMENTED = 501;

    /** @var String */
    protected $urlBase;

    /** @var String */
    protected $namespace;

    /** @var Array */
    protected $routes;

    /** @var Array */
    protected $currentRoute;

    /** @var int */
    protected $errno;

    /**
     * @return bool
     */
    public function boot(): bool
    {
        if (!$this->prepare())
            return false;

        $class = $this->currentRoute["namespace"] . "\\" . explode("@", $this->currentRoute["action"])[0];
        $method = explode("@", $this->currentRoute["action"])[1];

        if (!class_exists($class)) {
            $this->errno = self::NOTIMPLEMENTED;
            return false;
        }

        if (!method_exists($class, $method)) {
            $this->errno = self::NOTIMPLEMENTED;
            return false;
        }

        (new $class($this))->$method();

        return true;
    }

    /**
     * @return boolean
     */
    private function prepare(): bool
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $url = $this->getUrl();
        if (!array_key_exists($requestMethod, $this->routes)) {
            $this->errno = self::NOTIMPLEMENTED;
            return false;
        }

        if (!array_key_exists($url, $this->routes[$requestMethod])) {
            $this->errno = self::NOTFOUND;
            return false;
        }

        $this->currentRoute = $this->routes[$requestMethod][$url];
        if (empty($this->currentRoute["namespace"])) {
            throw new Exception("Namespace não definido");
            return false;
        }

        return true;
    }

    /**
     * @param string $name
     * @param array $args
     * @return null|string
     */
    public function route(string $name, array $args = []): ?string
    {
        if (count($this->routes) == 0)
            return null;

        foreach ($this->routes as $route) {
            if (count($route) == 0)
                return null;

            foreach ($route as $r) {
                if ($r["name"] === $name) {
                    $url = $r["url"] === "/" ? $this->urlBase : $this->urlBase . $r["url"];

                    return count($args) > 0 ? $url .= "?" . http_build_query($args) : $url;
                }
            }
        }

        return null;
    }

    /**
     * @param string $routeName
     * @param array $values
     * @return void
     */
    public function redirect(string $routeName, array $values = []): void
    {
        $url = $this->route($routeName, $values);
        if (!$url)
            $url = $this->urlBase . "/error";

        header("Location: {$url}");
        exit;
    }

    /**
     * @var null|int
     */
    public function error(): ?int
    {
        return $this->errno;
    }

    /**
     * @return string
     */
    private function getUrl(): string
    {
        $url = str_replace(
            str_replace(
                ["http://", "https://"],
                "",
                $this->urlBase
            ),
            "",
            $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]
        );

        if ($url == "/")
            return $url;

        $url = strpos($url, "?") !== false ? substr($url, 0, strpos($url, "?")) : $url;

        return $url;
    }
}
