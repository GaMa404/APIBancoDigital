<?php

namespace API\DAO;

use API\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
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

    public function select() : array
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "API\Model\CorrentistaModel");
    }

    public function update(CorrentistaModel $m) : bool
    {
        $sql = "UPDATE correntista SET nome=?, data_nasc=?, cpf=?, senha=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->data_nasc);
        $stmt->bindValue(3, $m->cpf);
        $stmt->bindValue(4, $m->senha);

        return $stmt->execute();
    }

    public function search(string $query) : array
    {
        $str_query = ['filtro' => '%' . $query . '%'];

        $sql = "SELECT * FROM correntista WHERE nome LIKE :filtro ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($str_query);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "API\Model\CorrentistaModel");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }

    public function selectByCpfSenha($cpf, $senha)
    {
        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();

        return $stmt->fetchObject("API\Model\CorrentistaModel");
    }
}