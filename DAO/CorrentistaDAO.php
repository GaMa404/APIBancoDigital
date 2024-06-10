<?php

namespace APIBancoDigital\DAO;

use APIBancoDigital\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function save(CorrentistaModel $m) : ?CorrentistaModel
    {
        return ($m->id == null) ? $this->insert($m) : $this->update($m);
    }

    public function insert(CorrentistaModel $model)
    {
        $sql = "INSERT INTO correntista (nome, email, data_nasc, cpf, senha, data_cadastro) VALUES (?, ?, ?, ?, sha1(?), ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->email);
        $stmt->bindValue(3, $model->data_nasc);
        $stmt->bindValue(4, $model->cpf);
        $stmt->bindValue(5, $model->senha);
        $stmt->bindValue(6, $model->data_cadastro);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;
    }

    public function select() : array
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "APIBancoDigital\Model\CorrentistaModel");
    }

    private function update(CorrentistaModel $m) 
   {
   }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function selectById(int $id)
    {
        include_once 'Model/CorrentistaModel.php';

        $sql = 'SELECT * FROM correntista WHERE id=?';

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("APIBancoDigital\Model\CorrentistaModel");
    }

    public function selectByCpfSenha(CorrentistaModel $model)
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->cpf);
        $stmt->bindValue(2, $model->senha);
        $stmt->execute();

        return $stmt->fetchObject("APIBancoDigital\Model\CorrentistaModel");
    }
}