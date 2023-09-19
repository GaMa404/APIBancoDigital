<?php

namespace APIBancoDigital\Model;

use APIBancoDigital\DAO\CorrentistaDAO;
use APIBancoDigital\DAO\ContaDAO;
use DateTime;

class CorrentistaModel extends Model
{
    public $id, $email, $nome, $data_nasc, $cpf, $senha, $data_cadastro;
    public $rows_contas;

    public function save() : ?CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->save($this);

        if($model_preenchido->id != null)
        {
            $dao_conta = new ContaDAO();

            $conta_corrente = new ContaModel();
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            $conta_poupanca = new ContaModel();
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        return $model_preenchido;
    }

    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select();
    }

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }

    public function getById(int $id)
   {
        $dao = new CorrentistaDAO();

        $obj = $dao->selectById($id);

        return ($obj) ? $obj : new CorrentistaModel();
   }

    public function autenticarLoginCorrentista()
    {
        $dao = new CorrentistaDAO();

        return $dao->selectByCpfSenha($this);
    }
}