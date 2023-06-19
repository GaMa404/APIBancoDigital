<?php

namespace APIBancoDigital\DAO;

use APIBancoDigital\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(CorrentistaModel $m) : bool
    {
        $sql = "INSERT INTO correntista (nome, email, data_nasc, cpf, senha, data_cadastro) VALUES (?, ?, ?, ?, sha1(?), ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->email);
        $stmt->bindValue(3, $m->data_nasc);
        $stmt->bindValue(4, $m->cpf);
        $stmt->bindValue(5, $m->senha);
        $stmt->bindValue(6, $m->data_cadastro);

        $stmt->execute();
        return $this->conexao->lastInsertId();
    }

    public function select() : array
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "APIBancoDigital\Model\CorrentistaModel");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function selectByCpfSenha(CorrentistaModel $model)
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->cpf);
        $stmt->bindValue(2, $model->senha);
        $stmt->execute();

        return $stmt->fetchObject("APIBancoDigital\Model\CorrentistaModel");
    }
}