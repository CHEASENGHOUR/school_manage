<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, callable $callback, array $middleware = []): void
    {
        $this->routes['GET'][$uri] = [
            'callback' => $callback,
            'middleware' => $middleware
        ];
    }

    public function post(string $uri, callable $callback, array $middleware = []): void
    {
        $this->routes['POST'][$uri] = [
            'callback' => $callback,
            'middleware' => $middleware
        ];
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->routes[$method][$uri] ?? null;

        if (!$route) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // Run middleware
        foreach ($route['middleware'] as $middleware) {
            if (method_exists($middleware, 'handle')) {
                $middleware->handle();
            }
        }

        // Run controller
        call_user_func($route['callback']);
    }
}
