<?php

use APIBancoDigital\Controller\ChavePixController;
use APIBancoDigital\Controller\ContaController;
use APIBancoDigital\Controller\CorrentistaController;
use APIBancoDigital\Controller\Controller;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
{
    Controller::setHeaders();
    http_response_code(204);
    exit();
}

switch($uri)
{
    // OK
    case '/correntista':
        CorrentistaController::select();
    break;

    case '/correntista/salvar':
        CorrentistaController::save();
    break;

    case '/correntista/deletar':
        CorrentistaController::delete();
    break;

    case '/correntista/entrar':
        CorrentistaController::auth();
    break;

    case '/correntista/by_id':
        CorrentistaController::selectById();
    break;

    // ========================================
    
    case '/conta/dados':
        ContaController::ContaByCorrentista();
    break;

    case '/pix/chave/listar':
        ChavePixController::listar();
    break;

    case '/pix/chave/salvar':
        ChavePixController::salvar();
    break;

    case 'pix/chave/remover':
        ChavePixController::remover();
    break;

    case '/conta/extrato':
        //ContaController::extrato();
    break;

    case '/transacao/pix/receber':
        //TransacaoController::receberPix();
    break;

    case '/transacao/pix/enviar':
        //TransacaoController::enviarPix();
    break;

    default: 
        http_response_code(403);
    break;
}