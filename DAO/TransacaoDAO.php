<?php

namespace APIBancoDigital\DAO;

use APIBancoDigital\Model\TransacaoModel;
use \PDO;

class TransacaoDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert(TransacaoModel $model)
    {
        $sql = "";
    }
}