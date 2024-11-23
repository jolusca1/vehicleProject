<?php

class Router
{
    private $routes = [];

    // Adicionar rotas
    public function add($method, $route, $callback)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => $this->formatRoute($route),
            'callback' => $callback
        ];
    }

    // Processar a rota atual
    public function dispatch()
    {
        $requestedMethod = $_SERVER['REQUEST_METHOD'];
        $requestedUri = $this->formatRoute($_SERVER['REQUEST_URI']);

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestedMethod && preg_match($route['route'], $requestedUri, $params)) {
                array_shift($params);
                return $this->executeCallback($route['callback'], $params);
            }
        }

        http_response_code(404);
        echo "404 - Página não encontrada.";
    }

    // Formatar a rota
    private function formatRoute($route)
    {
        $route = rtrim($route, '/');
        return '/^' . str_replace(['{id}', '/'], ['(\d+)', '\/'], $route) . '$/';
    }

    // Executar o callback
    private function executeCallback($callback, $params)
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, $params);
        }

        if (is_string($callback)) {
            $parts = explode('@', $callback);
            $controllerName = $parts[0];
            $methodName = $parts[1];

            require_once __DIR__ . "/../controllers/$controllerName.php";

            $controller = new $controllerName();
            return $controller->{$methodName}(...$params);
        }

        throw new Exception("Callback inválido");
    }

    // Renderizar uma view
    public function render($view, $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . "/../views/$view.php";

        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Erro: A view '$view' não foi encontrada.";
        }
    }
}
