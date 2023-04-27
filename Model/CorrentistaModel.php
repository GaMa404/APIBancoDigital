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

    public function getAllRows(string $query = null)
    {
        $dao = new CorrentistaDAO();

        $this->rows = ($query == null) ? $dao->select() : $dao->search($query);
    }


    public function autenticar()
    {
        $dao = new CorrentistaDAO();

        $dados_usuario_logado = $dao->SelectByCpfSenha($this->cpf, $this->senha);

        if(is_object($dados_usuario_logado))
        {
            return $dados_usuario_logado;
        }
        else
        {
            null;
        }
    }

    public function delete(int $id)
    {
        (new CorrentistaDAO())->delete($id);
    }
}