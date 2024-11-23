<?php

class Veiculo
{
    private $id;
    private $marca;
    private $modelo;
    private $ano;
    private $valor;

    public function __construct($id)
    {
        if ($id)
        {
            $this->findVeiculoById($id);
        }
    }

    public function findVeiculoById($id)
    {
        $stmt = Database::connect()->prepare("SELECT * FROM tbl_veiculos WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result)
        {
            $this->id = $data['id'];
            $this->marca = $data['marca'];
            $this->modelo = $data['modelo'];
            $this->ano = $data['ano'];
            $this->valor = $data['valor'];
    }
}