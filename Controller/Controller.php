<?php

namespace APIBancoDigital\Controller;

use Exception;

abstract class Controller
{
    protected static function LogError(Exception $e)
    {
        $f = fopen("erros.txt", "w");
        fwrite($f, $e->getTraceAsString());
    }

    public static function getResponseAsJSON($data)
    {
        self::setHeaders();

        exit(json_encode($data));
    }

    public static function setResponseAsJSON($data, $request_status = true)
    {
        self::setHeaders();

        $response = array('response_data' => $data, 'response_successful' => $request_status);

        exit(json_encode($data));
    }

    public static function getExceptionAsJSON(Exception $e)
    {
        self::setHeaders();

        $exception = 
        [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'traceAsString' => $e->getTraceAsString(),
            'previous' => $e->getPrevious()
        ];

        http_response_code(400);

        exit(json_encode($exception));
    }

    protected static function isGet()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'GET')
        {
            throw new Exception("O método de requisição deve ser GET");
        }
    }

    protected static function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            throw new Exception("O método de requisição deve ser POST");
        }
    }

    protected static function getIntFromUrl($var_get, $var_name = null) : int
    {
        self::isGet();

        if(!empty($var_get))
        {
            return (int) $var_get;
        }
        else
        {
            throw new Exception ("Variável $var_name não identificada.");
        }
    }

    protected static function getStringFromUrl($var_get, $var_name = null) : string
    {
        self::isGet();

        if(!empty($var_get))
        {
            return (string) $var_get;
        }
        else
        {
            throw new Exception ("Variável $var_name não identificada.");
        }
    }

    public static function setHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Content-type: application/json; charset-utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header("Pragma: no-cache");
    }
}
