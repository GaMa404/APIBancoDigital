<?php

namespace APIBancoDigital\DAO;

use APIBancoDigital\Model\ChavePixModel;
use PDO;

class ChavePixDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(ChavePixModel $model) : ?ChavePixModel
    {
        return ($model->id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(ChavePixModel $model) : ?ChavePixModel
    {
        $sql = "INSERT INTO chave_pix (id_conta, tipo, chave) VALUES (?, ?, ?)";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_conta);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->chave);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function update(ChavePixModel $model) : ?ChavePixModel
    {
        $sql = "UPDATE chave_pix SET id_conta=?, tipo=?, chave=? WHERE id=?";
        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_conta);
        $stmt->bindValue(2, $model->tipo);
        $stmt->bindValue(3, $model->chave);
        $stmt->bindValue(4, $model->id);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }
}