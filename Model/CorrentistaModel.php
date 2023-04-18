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
        else
        {
            (new CorrentistaDAO())->update($this);
        }
    }
}