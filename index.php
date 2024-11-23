<?php

require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Database.php';

$router = new Router();

// Registrar rotas
$router->add('GET', '/', function () use ($router) {
    $router->render('home');
});

$router->add('GET', '/veiculos', function () use ($router) {
    $controller = new VeiculoController($router);
    $controller->index();
});

$router->add('GET', '/veiculos/create', function () use ($router) {
    $controller = new VeiculoController($router);
    $controller->create();
});

$router->add('POST', '/veiculos/create', function () use ($router) {
    $controller = new VeiculoController($router);
    $controller->create();
});

$router->add('GET', '/veiculos/{id}', function ($id) use ($router) {
    $controller = new VeiculoController($router);
    $controller->show($id);
});

$router->add('POST', '/veiculos/delete/{id}', function ($id) use ($router) {
    $controller = new VeiculoController($router);
    $controller->delete($id);
});

// Processar rotas
$router->dispatch();
