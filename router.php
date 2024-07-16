<?php
class Router
{
    private $routes = [];

    public function addRoute($path, $controller, $method)
    {
        $this->routes[$path] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($path)
    {
        if (isset($this->routes[$path])) {
            $controller = new $this->routes[$path]['controller']();
            $method = $this->routes[$path]['method'];
            $controller->$method();
        } else {
            echo "404 Not Found";
        }
    }
}