<?php

namespace Api\Controller;

use Api\Model\ContaModel;
use Exception;

class ContaController extends Controller
{
    public static function save() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ContaModel();
            $model->id = $json_obj->Id;
            $model->numero = $json_obj->Numero;
            $model->tipo = $json_obj->Tipo;
            $model->senha = $json_obj->Senha;
            $model->id_correntista = $json_obj->Id_correntista;

            $model->save();
        }
        catch (Exception $e) 
        {
            parent::getExceptionAsJSON($e);
        }   
    }

    public static function getAllRows() : void
    {
        try
        {
            $model = new ContaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
    }

    public static function delete()
    {
        //parent::isAuthenticated();

        $model = new ContaModel();

        $model->delete( (int) $_GET['id'] );

        header("Location: /funcionario");
    }

    public static function extrato()
    {
    }

    public static function enviarPix()
    {

    }
    
    public static function receberPix()
    {
    }
}