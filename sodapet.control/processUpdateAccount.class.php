<?php
/* 
* Classe processUpdateAccount
* Classe responsável pelo recebimento das informações por POST para a criação das contas do tipo 'ONG' e 'USUARIO'
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

// Verifica se há sessão ativa no sistema
if(isset($_SESSION['tipo']))
{
	// armazena o tipo da conta á ser criada
	$type = $_POST['type'];

	// Verifica qual o tipo de conta para a execução da ação correta
	Switch($type)
	{
		// Criação da conta do tipo Ong
		case 'ong':

			$nomefantasia 	= $_POST['nomefantasia'];
			$cnpj 			= str_replace('.','',str_replace('-','',str_replace('/','',$_POST['cnpj'])));
			$razaosocial 		= $_POST['razaosocial'];
			$cep 			= str_replace('-','',$_POST['cep']);
			$endereco 		= $_POST['endereco'];
			$numero 		= $_POST['numero'];
			$complemento 		= $_POST['Complemento'];
			$bairro 		= $_POST['bairro'];
			$cidade 		= $_POST['cidade'];
			$estado 		= $_POST['estado'];
			$telefonecomercial 	= '55'.str_replace('(','',str_replace(')','',str_replace(' ','',str_replace('-','',$_POST['telefonecomercial']))));
			$telefonemovel 		= '55'.str_replace('(','',str_replace(')','',str_replace(' ','',str_replace('-','',$_POST['telefonemovel']))));
			$idfacebook 		= $_POST['idfacebook'];
			$idtwitter 		= $_POST['idtwitter'];
			$website 		= $_POST['website'];
			$descricao 		= $_POST['descricao'];
			$especialidade 		= $_POST['especialidade'];
			$logotipo 		= file_get_contents($_FILES['logotipo']['tmp_name']);
			$email 			= $_POST['email'];
			$senha 			= $_POST['senha'];

			// Instancia as informações consultadas no BD sobre o usuário para a comparação antes da atualização
			$infoAccount = OperationAccount::loadInfoAccountOng($_POST['emailvalue']);

			// Instância objeto para checar a existência da conta
			$checkEmail = OperationAccount::loadInfoAccount($email);
			
			// Instância objeto para checar a existência de um CNPJ
			$checkCnpj = OperationAccount::checkCnpj($cnpj);

			// Verifica se o email ou o CNPJ informado já estão cadastrados para outros usuários
			if($checkCnpj && $cnpj != $infoAccount[1])
			{
				// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o CNPJ existente
				header("Location: ../editAccount.php?&erro=cnpj");		
				
			}
			else if($checkEmail && $email != $infoAccount[0])
			{
				// Retorna para a página 'editAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o Email existente
				header("Location: ../editAccount.php?&erro=email");	

			}
			else if($_FILES['logotipo']['type'] != 'image/jpeg' && $_FILES['logotipo']['error'] == 0)
			{

				// Retorna para a página 'editAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
				header("Location: ../editAccount.php?&erro=imgformato");
			
			}
			else if($_FILES['logotipo']['error'] == 1)
			{
				// Retorna para a página 'editAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tamanho excedido existente
				header("Location: ../editAccount.php?&erro=imgtamanho");
			}
			else
			{
				
				if($_FILES['logotipo']['tmp_name'] == '')
				{			
					// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a atualização da conta
					$atualizacaoConta = new OngAccount($email, $senha, 'OK', $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $telefonemovel, $idfacebook, $idtwitter, $cnpj, $razaosocial, $nomefantasia, $descricao, $infoAccount[5], $especialidade, $telefonecomercial, $website);
								
					// Efetua a tentativa de atualização da conta
					if($atualizacaoConta->updateAccount($infoAccount[0]))
					{
						// Instancia as informações consultadas no BD sobre o usuário
						$infoAccountUpdated = OperationAccount::loadInfoAccountOng($email);
						$_SESSION['info'] = $infoAccountUpdated;
						$_SESSION['tipo'] = 'ONG';
						
						// Redireciona o usuário para a página de 'sucesso'
						header("Location: ../editAccount.php?success=yes");
					}
					else
					{	
						// Caso haja algum erro na atualização da conta (conexão com o BD)
						header("Location: ../editAccount.php?&erro=bd");
					}
				}
				else
				{		
					// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a atualização da conta
					$atualizacaoConta = new OngAccount($email, $senha, 'OK', $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $telefonemovel, $idfacebook, $idtwitter, $cnpj, $razaosocial, $nomefantasia, $descricao, $logotipo, $especialidade, $telefonecomercial, $website);
								
					// Efetua a tentativa de atualização da conta
					if($atualizacaoConta->updateAccount($infoAccount[0]))
					{
						// Instancia as informações consultadas no BD sobre o usuário
						$infoAccountUpdated = OperationAccount::loadInfoAccountOng($email);
						$_SESSION['info'] = $infoAccountUpdated;
						$_SESSION['tipo'] = 'ONG';
						
						// Redireciona o usuário para a página de 'sucesso'
						header("Location: ../editAccount.php?success=yes");
					}
					else
					{	
						// Caso haja algum erro na atualização da conta (conexão com o BD)
						header("Location: ../editAccount.php?&erro=bd");
					}				
				}
			}

		break;

		case 'user':

			$nomecompleto 		= $_POST['nomecompleto'];
			$cpf 			= str_replace('.','',str_replace('-','',$_POST['cpf']));
			$datanascimento		= substr(str_replace('/','',$_POST['datanascimento']),'4','4').'-'.substr(str_replace('/','',$_POST['datanascimento']),'2','2').'-'.substr(str_replace('/','',$_POST['datanascimento']),'0','2');
			$sexo			= $_POST['sexo'];
			$estadocivil		= $_POST['estadocivil'];
			$cep 			= str_replace('-','',$_POST['cep']);
			$endereco 		= $_POST['endereco'];
			$numero 		= $_POST['numero'];
			$complemento 		= $_POST['Complemento'];
			$bairro 		= $_POST['bairro'];
			$cidade 		= $_POST['cidade'];
			$estado 		= $_POST['estado'];
			$telefoneresidencial 	= '55'.str_replace('(','',str_replace(')','',str_replace(' ','',str_replace('-','',$_POST['telefoneresidencial']))));
			$telefonemovel 		= '55'.str_replace('(','',str_replace(')','',str_replace(' ','',str_replace('-','',$_POST['telefonemovel']))));
			$idfacebook 		= $_POST['idfacebook'];
			$idtwitter 		= $_POST['idtwitter'];
			$preferenciaanimal	= $_POST['preferenciaanimal'];
			$tipomoradia		= $_POST['tipomoradia'];
			$adotouanimal		= $_POST['adotouanimal'];
			$email 			= $_POST['email'];
			$senha 			= $_POST['senha'];

			// Instancia as informações consultadas no BD sobre o usuário para a comparação antes da atualização
			$infoAccount = OperationAccount::loadInfoAccountUser($_POST['emailvalue']);

			// Instância objeto para checar a existência da conta
			$checkEmail = OperationAccount::loadInfoAccount($email);
			
			// Instância objeto para checar a existência de um CPF
			$checkCpf = OperationAccount::checkCpf($cpf);

			// Verifica se o email ou o CNPJ informado já estão cadastrados
			if($checkCpf && $cpf != $infoAccount[1])
			{
				// Retorna para a página 'editAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o CNPJ existente
				header("Location: ../editAccount.php?erro=cpf");	
				
			}
			else if($checkEmail && $email != $infoAccount[0])
			{
				// Retorna para a página 'editAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o Email existente
				header("Location: ../editAccount.php?erro=email");	

			}
			else
			{
				// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a atualização da conta
				$atualizacaoConta = new UserAccount($email, $senha, 'OK', $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $telefonemovel, $idfacebook, $idtwitter, $cpf, $nomecompleto, $datanascimento, $sexo, $estadocivil, $tipomoradia, $preferenciaanimal, $adotouanimal, $telefoneresidencial);

				// Efetua a tentativa de criação da conta
				if($atualizacaoConta->updateAccount($infoAccount[0]))
				{
					// Instancia as informações consultadas no BD sobre o usuário
					$infoAccountUpdated = OperationAccount::loadInfoAccountUser($email);
					$_SESSION['info'] = $infoAccountUpdated;
					$_SESSION['tipo'] = 'USUARIO';

					// Redireciona o usuário para a página de 'sucesso'
					header("Location: ../editAccount.php?success=yes");
				}
				else
				{	
					// Caso haja algum erro na atualização da conta (conexão com o BD)
					header("Location: ../editAccount.php?&erro=bd");
				}
				
			}

		break;

		default:
		
		header('Location: ../');
		
	}
}
else
{
	header('Location: ../');
}
?>
