<?php 

namespace APIBancoDigital\Controller;

use APIBancoDigital\Model\ChavePixModel;
use Exception;

class ChavePixController extends Controller
{
    public static function salvar() : void
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();

            foreach (get_object_vars($data) as $key =>$value)
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }

            parent::getResponseAsJSON($model->save());
        }
        catch(Exception $e)
        {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public function listar() : void
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();
        
            parent::getResponseAsJSON($model->getAllRows($data->id_correntista));
        }
        catch(Exception $e)
        {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public function remover()
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new ChavePixModel();

            foreach(get_object_vars($data) as $key => $value)
            {
                $prop_letra_minuscula = $strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }

            parent::getResponseAsJSON($model->save());
        }
        catch(Exception $e)
        {
            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }
}