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
        $sql = "INSERT INTO conta (numero, saldo, limite, tipo, id_correntista) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->numero);
        $stmt->bindValue(2, $model->saldo);
        $stmt->bindValue(3, $model->limite);
        $stmt->bindValue(4, $model->tipo);
        $stmt->bindValue(5, $model->id_correntista);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function select() : array
    {
        $sql = "SELECT * FROM conta";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "APIBancoDigital\Model\ContaModel");
    }

    public function update(ContaModel $m) : bool
    {
        $sql = "UPDATE conta SET numero=?, saldo=?, limite=?, tipo=?, data_abertura=?, id_correntista=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->numero);
        $stmt->bindValue(2, $m->saldo);
        $stmt->bindValue(3, $m->limite);
        $stmt->bindValue(4, $m->tipo);
        $stmt->bindValue(5, $m->id_correntista);
        $stmt->bindValue(6, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM conta WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
    
    public function search(string $query) : array
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
    }
}