<?php

require_once __DIR__.'/models/Veiculo.php';


class VeiculoController
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function index($id)
    {
        $veiculo = new Veiculo();
        $veiculo->findVeiculoById($id);
}