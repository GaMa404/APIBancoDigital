<?php

namespace API\Model;

use API\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $id, $nome, $data_nasc, $cpf, $senha;

    public function save()
    {
        if($this->id == null)
        {
            (new CorrentistaDAO())->insert($this);
        }
    }

    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select();
    }

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }

    public function autenticarLoginCorrentista()
    {
        $dao = new CorrentistaDAO();

        return $dao->selectByCpfSenha($this);
    }
}