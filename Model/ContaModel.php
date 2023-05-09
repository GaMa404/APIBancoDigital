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
    }

    public function getAllRows(string $query = null)
    {
        $dao = new ContaDAO();

        $this->rows = ($query == null) ? $dao->select() : $dao->search($query);
    }

    public function delete()
    {
        (new ContaDAO())->delete($this->id);
    }
}