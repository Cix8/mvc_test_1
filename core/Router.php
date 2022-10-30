<?php

namespace Core;

use Exception;
use PDO;

class Router
{

    protected PDO $conn;

    protected array $routes = [
        "GET" => [],
        "POST" => []
    ];

    public function __construct(PDO $_conn)
    {
        $this->conn = $_conn;
    }

    public function assignRoutes(array $_routes)
    {
        $this->routes = $_routes;
    }

    public function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = trim($url, '/');
        $method = $_SERVER['REQUEST_METHOD'];
        if (
            array_key_exists($method, $this->routes) &&
            array_key_exists($url, $this->routes[$method])
        ) {
            return $this->route($this->routes[$method][$url]);
        } else {
            //throw new Exception('Method not found');
            return $this->processQueue($url, $method);
        }
    }

    protected function route($uri, array $data = [])
    {
        try {
            if(is_callable($uri)){
                return call_user_func_array($uri, $data);
            }
            $path_array = explode('@', $uri);
            $controller = $path_array[0];
            $method = $path_array[1];
            $class = new $controller($this->conn);
            if (method_exists($class, $method)) {

                call_user_func([$class, $method], $data[0]);
                return $class;
            } else {
                throw new Exception('Metodo ' . $method . ' non trovato nella classe ' . $controller);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    protected function processQueue($uri, $method = 'GET')
    {
        $routes = $this->routes[$method];
        //print_r($routes);

        foreach ($routes as $route => $callback) {
            // converte url '/post/:id' in regular expression
            $regMatch = preg_quote($route);
            // :id ([a-zA-Z0-9\-\_]+)

            // post/([a-zA-Z0-9\-\_]+) # nota: ([a-zA-Z0-9\-\_]+) == ([a-z0-9\-\_]i+)
            $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $regMatch);

            // @^post/([a-zA-Z0-9\-\_]+)$@
            $pattern = '@^' . $subPattern . '$@D';

            // echo $pattern . '<br>';

            $matches = [];
            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches);
                return $this->route($callback, $matches);
            }
        }
        throw new Exception('Nessuna rotta corrispondente per ' . $uri);
    }
}
