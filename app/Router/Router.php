<?php

class Router
{
    private $routes = [];

    public function get($path, $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post($path, $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    private function addRoute($method, $path, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $this->normalizePath($path),
            'callback' => $callback,
            'params' => $this->extractParams($path),
        ];
    }

    private function normalizePath($path)
    {
        return '/' . trim($path, '/');
    }

    private function extractParams($path)
    {
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $path, $matches);
        return $matches[1];
    }

    private function matchRoute($method, $requestPath)
    {
        $requestPath = $this->normalizePath($requestPath);
        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^\/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';
            if (preg_match($pattern, $requestPath, $matches)) {
                array_shift($matches);
                $params = [];
                foreach ($route['params'] as $index => $name) {
                    $params[$name] = $matches[$index];
                }
                return ['callback' => $route['callback'], 'params' => $params];
            }
        }
        return null;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->matchRoute($method, $requestUri);
        if ($route) {
            if (is_callable($route['callback'])) {
                call_user_func_array($route['callback'], $route['params']);
            } elseif (is_string($route['callback'])) {
                $this->handleControllerAction($route['callback'], $route['params']);
            }
        } else {
            http_response_code(404);
            echo "Página não encontrada!";
        }
    }

    private function handleControllerAction($callback, $params)
    {
        list($controllerName, $method) = explode('@', $callback);
        $controllerFile = __DIR__ . '/../Controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName($GLOBALS['mysqli']);
                if (method_exists($controller, $method)) {
                    call_user_func_array([$controller, $method], $params);
                } else {
                    http_response_code(500);
                    echo "Método não encontrado no controlador.";
                }
            } else {
                http_response_code(500);
                echo "Controlador não encontrado.";
            }
        } else {
            http_response_code(500);
            echo "Arquivo do controlador não encontrado.";
        }
    }
}
