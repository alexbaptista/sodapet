<?php
/* 
* Classe logout
* Classe responsável pelo registro de logout nas contas do tipo 'ONG' e 'USUARIO'
*/

// Início da sessão ativa
session_start();

/*
* função __autoload
* Para carregar as classes necessárias da camada "model" para a execução das operações de forma tem.
*/
function __autoload($classe)
{
    if (file_exists("../sodapet.model/{$classe}.class.php"))
    {
        include_once "../sodapet.model/{$classe}.class.php";
    }
    else if (file_exists("../sodapet.model/sodapet.ado/{$classe}.class.php"))
    {
        include_once "../sodapet.model/sodapet.ado/{$classe}.class.php";
    }
}

// Finalização da sessão ativa
session_destroy();

// define a estratégia de LOG
STransaction::setLogger(new SLoggerTXT('OPERATION'));

// escreve a mensagem de LOG
STransaction::log("Logout realizado com sucesso");

// fecha a transação, aplicando todas as operações
STransaction::close();

// Retorno á home page
header('Location: ../');
?>
