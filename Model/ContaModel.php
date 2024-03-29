<?php

namespace APIBancoDigital\Model;

use APIBancoDigital\DAO\ContaDAO;

class ContaModel extends Model
{
    public $id, $saldo, $limite, $tipo, $data_abertura, $id_correntista;

    public function ContaByCorrentista()
    {
        $dao = new ContaDAO();

        return $dao->selectByCorrentista($this);
    }

    public function save()
    {
        $dao = new ContaDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        } 
        else 
        {
            //$dao->update($this);
        }        
    }

    /*public function getAllRows(string $query = null)
    {
        $dao = new ContaDAO();

        $this->rows = ($query == null) ? $dao->select() : $dao->search($query);
    }*/

    public function delete()
    {
        (new ContaDAO())->delete($this->id);
    }
}