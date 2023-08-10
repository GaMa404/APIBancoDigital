<?php

use APIBancoDigital\Controller\ChavePixController;
use APIBancoDigital\Controller\CorrentistaController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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