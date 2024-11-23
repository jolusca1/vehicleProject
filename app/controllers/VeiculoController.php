<?php

require_once __DIR__.'/models/Veiculo.php';


class VeiculoController
{
    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function index()
    {
        $veiculos = new Veiculo();
        $veiculos->listAllVeiculos();
        $this->router->render('veiculos/index', ['veiculos' => $veiculos]);
    }

    public function create()
    {
        $veiculo = new Veiculo();
        $veiculoDTO = new VeiculoDTO();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $veiculoDTO->setId($_POST['id']);
            $veiculoDTO->setMarca($_POST['marca']);
            $veiculoDTO->setModelo($_POST['modelo']);
            $veiculoDTO->setAno($_POST['ano']);
            $veiculoDTO->setValor($_POST['valor']);

            $veiculo->saveVeiculo($veiculoDTO);
        }
    }
}