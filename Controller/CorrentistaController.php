<?php

namespace APIBancoDigital\Controller;

use APIBancoDigital\Model\CorrentistaModel;
use Exception;

class CorrentistaController extends Controller 
{
    public static function save() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            $model->id = $json_obj->Id;
            $model->nome = $json_obj->Nome;
            $model->email = $json_obj->Email;
            $model->data_nasc = $json_obj->Data_nasc;
            $model->cpf = $json_obj->Cpf;
            $model->senha = $json_obj->Senha;
            $model->data_cadastro = $json_obj->Data_cadastro;

            $model->save();
        }
        catch(Exception $e)
        {
            parent::getExceptionAsJSON($e);
        }
    }

    public static function select() : void
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

    public static function delete() : void 
	{
		try
		{
			$model = new CorrentistaModel();

			$model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id'] : null);

			$model->delete();
		}
		catch(Exception $e)
		{
			parent::getExceptionAsJSON($e);
		}
	}

    public static function auth()
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->cpf = $json_obj->Cpf;
            $model->senha = $json_obj->Senha;

            parent::getResponseAsJSON($model->autenticarLoginCorrentista());
        } catch (Exception $err) {
            parent::getExceptionAsJSON($err);
        }
    }
}