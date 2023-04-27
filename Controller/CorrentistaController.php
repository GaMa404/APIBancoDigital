<?php

namespace API\Controller;

use API\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller 
{
    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->data_nasc = $json_obj->Data_nasc;
            $model->cpf = $json_obj->Cpf;
            $model->senha = $json_obj-> Senha;

            $model->save();
        }
        catch(Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function listar() : void
    {
        try
        {
            $model = new CorrentistaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
    }

    public static function auth()
    {
        $model = new CorrentistaModel();

        $model->cpf = $_POST['cpf'];
        $model->senha = $_POST['senha'];

        $usuario_logado = $model->autenticar();

        if($usuario_logado !== null)
        {
            $_SESSION['usuario_logado'] = $usuario_logado;
        }
    }

    /*public static function logout()
    {
        unset($_SESSION['usuario_logado']);

        parent::isAuthenticated();
    }*/
}