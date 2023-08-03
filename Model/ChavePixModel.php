<?php

namespace APIBancoDigital\Model;

use APIBancoDigital\DAO\ChavePixDAO;

class ChavePixModel extends Model
{
    public $id, $id_conta, $tipo, $chave;

    public function save() : ?ChavePixModel
    {
        return (new ChavePixDAO())->save($this);
    }

    public function getAllRows(int $id_correntista) : array
    {
        return (new ChavePixDAO())->select($id_correntista);
    }

    public function remove() : bool
    {
        return (new ChavePixDAO())->delete($this);
    }
}