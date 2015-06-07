<?php
/* 
* Classe logon
* Classe responsável pelo registro de logon nas contas do tipo 'ONG' e 'USUARIO'
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

// Recebe as informações vindas do formulário
$user = $_POST['email'];
$password = $_POST['senha'];

// Instância objeto para checar a existência da conta
$logon = OperationAccount::checkPasswordAccount($user);

// Verifica o resultado da existência da conta
if($logon)
{
	// armazena o resultado do status da conta
	$Status = OperationAccount::checkStatusAccount($user);
	
	// caso o status da conta esteja regular
	if($Status[0] == 'OK')
	{
		// Verifica se a senha da conta está correta
		if($logon[0] == md5($password))
		{
			// Verifica se é uma conta do tipo "ONG" ou "USUARIO"
			$tipo = OperationAccount::checkTypeAccount($user);

			// Executa as condicionais de acordo com o tipo de conta
			if($tipo[0] == 'ONG')
			{
				// Instancia as informações consultadas no BD sobre o usuário
				$infoAccount = OperationAccount::loadInfoAccountOng($user);
				$_SESSION['info'] = $infoAccount;
				$_SESSION['tipo'] = $tipo[0];

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));

				// escreve a mensagem de LOG
				STransaction::log("Tentativa de autenticação '" . $user . "' ======> Logado com sucesso (ONG)");

				// fecha a transação, aplicando todas as operações
				STransaction::close();

				// Retorno á home page
				header('Location: ../?status=200');
			}
			else if($tipo[0] == 'USUARIO')
			{
				// Instancia as informações consultadas no BD sobre o usuário
				$infoAccount = OperationAccount::loadInfoAccountUser($user);
				$_SESSION['info'] = $infoAccount;
				$_SESSION['tipo'] = $tipo[0];

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));

				// escreve a mensagem de LOG
				STransaction::log("Tentativa de autenticação '" . $user . "' ======> Logado com sucesso (USUARIO)");

				// fecha a transação, aplicando todas as operações
				STransaction::close();

				// Retorno á home page
				header('Location: ../?status=200');
			}
		}
		else
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Tentativa de autenticação '" . $user . "' ======> Senha incorreta");

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			// Retorno á home page
			header('Location: ../?status=403');
		}
	}
	else
	{
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('ERROR'));

		// escreve a mensagem de LOG
		STransaction::log("Tentativa de autenticação '" . $user . "' ======> Conta bloqueada");

		// fecha a transação, aplicando todas as operações
		STransaction::close();

		// Retorno á home page
		header('Location: ../?status=500');
	}	
}
else
{
	// define a estratégia de LOG
	STransaction::setLogger(new SLoggerTXT('ERROR'));

	// escreve a mensagem de LOG
	STransaction::log("Tentativa de autenticação '" . $user . "' ======> Conta não existe");

	// fecha a transação, aplicando todas as operações
	STransaction::close();

	// Retorno á home page
	header('Location: ../?status=404');
}
?>
