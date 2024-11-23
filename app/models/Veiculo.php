<?php

class Veiculo
{
    public function listAllVeiculos()
    {
        $sql = "SELECT * FROM tbl_veiculos";
        $stmt = Database::connect()->prepare(query: $sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function findVeiculoById($id)
    {
        $stmt = Database::connect()->prepare('SELECT * FROM tbl_veiculos WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result)
        {
            $this->id = $result['id'];
            $this->marca = $result['marca'];
            $this->modelo = $result['modelo'];
            $this->ano = $result['ano'];
            $this->valor = $result['valor'];
        }

        return $result
    }

    public function saveVeiculo(VeiculoDTO $veiculo)
    {
        if ($this->id)
        {
            $sql = "UPDATE tbl_veiculos SET marca = :marca, modelo = :modelo, ano = :ano, preco = :preco WHERE id = :id";
        } else
        {
            $sql = "INSERT INTO tbl_veiculos (marca, modelo, ano, preco) VALUES (:marca, :modelo, :ano, :preco)";
        }

        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':marca', $veiculo->getMarca());
        $stmt->bindValue(':modelo', $veiculo->getModelo());
        $stmt->bindValue(':ano', $veiculo->getAno());
        $stmt->bindValue(':valor', $veiculo->getValor());

        if (!$this->id)
        {
            $this->id = Database::connect()->lastInsertId();
        }
    }
}