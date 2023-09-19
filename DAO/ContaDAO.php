<?php

namespace APIBancoDigital\DAO;

use APIBancoDigital\Model\ContaModel;

class ContaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(ContaModel $model) : ?ContaModel
    {
        $sql = "INSERT INTO conta (saldo, limite, tipo, id_correntista) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->saldo);
        $stmt->bindValue(2, $model->limite);
        $stmt->bindValue(3, $model->tipo);
        $stmt->bindValue(4, $model->id_correntista);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function selectByCorrentista(ContaModel $model)
    {
        $sql = "SELECT * FROM conta WHERE tipo='C' AND id_correntista=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->id_correntista);
        $stmt->execute();

        return $stmt->fetchObject("APIBancoDigital\Model\ContaModel");
    }

    public function update(ContaModel $model) : bool
    {
        $sql = "UPDATE conta SET saldo=?, limite=?, tipo=?, data_abertura=?, id_correntista=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->saldo);
        $stmt->bindValue(2, $model->limite);
        $stmt->bindValue(3, $model->tipo);
        $stmt->bindValue(4, $model->data_abertura);
        $stmt->bindValue(5, $model->id_correntista);
        $stmt->bindValue(6, $model->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM conta WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
    
    /*public function search(string $query) : array
    {
        $str_query = ['filtro' => '%' . $query . '%'];

        $sql = "SELECT * FROM conta WHERE numero LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_query);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "APIBancoDigital\Model\ContaModel");
    }
    
    public function selectByNumero($numero)
    {
        $sql = "SELECT * FROM conta WHERE numero=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $numero);
        $stmt->execute();

        return $stmt->fetchObject("APIBancoDigital\Model\ContaModel");
    }*/
}