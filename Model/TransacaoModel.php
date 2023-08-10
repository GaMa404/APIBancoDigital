<?php

namespace APIBancoDigital\Model;

use APIBancoDigital\DAO\TransacaoDAO;

class TransacaoModel extends Model
{
    public $id;
    
    public function save()
    {
        $dao = new TransacaoDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        }
    }
}