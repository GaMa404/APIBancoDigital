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

            $model->id = $json_obj->id;
            $model->nome = $json_obj->nome;
            $model->email = $json_obj->email;
            $model->data_nasc = $json_obj->data_nasc;
            $model->cpf = $json_obj->cpf;
            $model->senha = $json_obj->senha;
            $model->data_cadastro = $json_obj->data_cadastro;

            $model->save();

            parent::getResponseAsJSON($model);
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

    public static function selectById() : void 
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->id = $json_obj->id;
            parent::getResponseAsJSON($model->getById($model->id));
        }
        catch(Exception $e)
        {
            parent::getExceptionAsJson($e);
        }
    }

    /*public static function delete() : void 
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
	}*/

    public static function auth()
    {
        try 
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();
            $model->cpf = $json_obj->cpf;
            $model->senha = $json_obj->senha;

            parent::getResponseAsJSON($model->autenticarLoginCorrentista());
        } catch (Exception $err) {
            parent::getExceptionAsJSON($err);
        }
    }
}