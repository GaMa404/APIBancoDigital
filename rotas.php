<?php

use API\Controller\CorrentistaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($uri)
{
    case '/correntista':
        CorrentistaController::listar();
    break;

    case '/correntista/save':
        CorrentistaController::salvar();
    break;

    case '/correntista/entrar':
        CorrentistaController::auth();
    break;

    /*case '/conta/pix/enviar':
        //ContaController::enviarPix();
    break;

    case '/conta/pix/receber':
        //ContaController::receberPix();
    break;

    case '/conta/extrato':
        //ContaController::extrato();
    break;*/

    default: 
        http_response_code(403);
    break;
}