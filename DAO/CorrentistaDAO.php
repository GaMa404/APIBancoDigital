<?php

namespace API\DAO;

use API\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function select()
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function insert(CorrentistaModel $m) : bool
    {
        $sql = "INSERT INTO correntista (nome, data_nasc, cpf, senha) VALUES (?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->data_nasc);
        $stmt->bindValue(3, $m->cpf);
        $stmt->bindValue(4, $m->senha);

        return $stmt->execute();
    }

    public function update(CorrentistaModel $m)
    {
        $sql = "UPDATE correntista SET nome=?, data_nasc=?, cpf=?, senha=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->data_nasc);
        $stmt->bindValue(3, $m->cpf);
        $stmt->bindValue(4, $m->senha);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROm correntista WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}