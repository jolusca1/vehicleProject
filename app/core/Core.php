<?php

class Core
{
    public function run()
    {
        // Obtém a URL atual
        $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : ['veiculos', 'index'];

        $controller = ucfirst($url[0]) . 'Controller';
        $action = $url[1] ?? 'index';

        if (class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            call_user_func_array([$controllerInstance, $action], array_slice($url, 2));
        } else {
            echo "404 - Página não encontrada.";
        }
    }
}
