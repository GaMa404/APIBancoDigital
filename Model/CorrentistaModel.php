<?php

namespace APIBancoDigital\Model;

use APIBancoDigital\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{
    public $id, $email, $nome, $data_nasc, $cpf, $senha, $data_cadastro;

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