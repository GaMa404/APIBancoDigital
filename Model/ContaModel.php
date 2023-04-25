<?php

namespace API\Model;

use API\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $numero, $tipo, $senha, $id_correntista;

    public function save()
    {
        if($this->id == null)
        {
            (new ContaDAO())->insert($this);
        }
        else
        {
            (new ContaDAO())->update($this);
        }
    }

    public function delete(int $id)
    {
        (new ContaDAO())->delete($id);
    }
}