<?php
/* 
* Classe processCreateAccount
* Classe responsável pelo recebimento das informações por POST para a criação das contas do tipo 'ONG' e 'USUARIO'
*/

// Início da sessão
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

// Para o envio de notificação por e-mail
include 'sendEmail.class.php';

// armazena o tipo da conta á ser criada
$type = $_POST['type'];

// Verifica qual o tipo de conta para a execução da ação correta
Switch($type)
{
	// Criação da conta do tipo Ong
	case 'ong':

		$nomefantasia 		= $_POST['nomefantasia'];
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

		// Armazena a descrição da ong em uma sessão, por ser uma váriavel muito grande para retornar por GET
		$_SESSION['descricaoong'] = $descricao;

		// Instância objeto para checar a existência da conta
		$checkEmail = OperationAccount::loadInfoAccount($email);
		
		// Instância objeto para checar a existência de um CNPJ
		$checkCnpj = OperationAccount::checkCnpj($cnpj);

		// Verifica se o email ou o CNPJ informado já estão cadastrados
		if($checkCnpj)
		{
			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o CNPJ existente
			header("Location: ../createAccount.php?type=ong&term=yes&nomefantasia=".$_POST['nomefantasia']."&cnpj=".$_POST['cnpj']."&razaosocial=".$_POST['razaosocial']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefonecomercial=".$_POST['telefonecomercial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&website=".$_POST['website']."&especialidade=".$_POST['especialidade']."&email=".$_POST['email']."&erro=cnpj");		
			
		}
		else if($checkEmail)
		{
			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o Email existente
			header("Location: ../createAccount.php?type=ong&term=yes&nomefantasia=".$_POST['nomefantasia']."&cnpj=".$_POST['cnpj']."&razaosocial=".$_POST['razaosocial']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefonecomercial=".$_POST['telefonecomercial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&website=".$_POST['website']."&especialidade=".$_POST['especialidade']."&email=".$_POST['email']."&erro=email");	

		}
		else if($_FILES['logotipo']['type'] != 'image/jpeg' && $_FILES['logotipo']['error'] == 0)
		{

			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
			header("Location: ../createAccount.php?type=ong&term=yes&nomefantasia=".$_POST['nomefantasia']."&cnpj=".$_POST['cnpj']."&razaosocial=".$_POST['razaosocial']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefonecomercial=".$_POST['telefonecomercial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&website=".$_POST['website']."&especialidade=".$_POST['especialidade']."&email=".$_POST['email']."&erro=imgformato");
		
		}
		else if($_FILES['logotipo']['error'] == 1)
		{
			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tamanho excedido existente
			header("Location: ../createAccount.php?type=ong&term=yes&nomefantasia=".$_POST['nomefantasia']."&cnpj=".$_POST['cnpj']."&razaosocial=".$_POST['razaosocial']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefonecomercial=".$_POST['telefonecomercial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&website=".$_POST['website']."&especialidade=".$_POST['especialidade']."&email=".$_POST['email']."&erro=imgtamanho");
		}
		else
		{
			// Verifica se o campo está vazio
			if($_FILES['imagem6']['tmp_name'] == '')
			{
				//$logotipo = file_get_contents('http://localhost/sodapet.org_1.0/sodapet.images/sem_imagem.jpg');
				$logotipo = file_get_contents('http://www.sodapet.org/sodapet.images/sem_imagem.jpg');
			}
			
			// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a criação da conta
			$novaConta = new OngAccount($email, $senha, 'OK', $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $telefonemovel, $idfacebook, $idtwitter, $cnpj, $razaosocial, $nomefantasia, $descricao, $logotipo, $especialidade, $telefonecomercial, $website);

			// Efetua a tentativa de criação da conta
			if($novaConta->createAccount())
			{
				// Envio de notificação de criação de conta
				sendEmail::newAccount($razaosocial, $email);
									
				// Redireciona o usuário para a página de 'sucesso'
				header("Location: ../success.php?success=yes");
			}
			else
			{	
				// Caso haja algum erro na criação da conta (conexão com o BD)
				header("Location: ../createAccount.php?type=ong&term=yes&nomefantasia=".$_POST['nomefantasia']."&cnpj=".$_POST['cnpj']."&razaosocial=".$_POST['razaosocial']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefonecomercial=".$_POST['telefonecomercial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&website=".$_POST['website']."&especialidade=".$_POST['especialidade']."&email=".$_POST['email']."&erro=bd");
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

		// Instância objeto para checar a existência da conta
		$checkEmail = OperationAccount::loadInfoAccount($email);
		
		// Instância objeto para checar a existência de um CPF
		$checkCpf = OperationAccount::checkCpf($cpf);

		// Verifica se o email ou o CNPJ informado já estão cadastrados
		if($checkCpf)
		{
			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o CNPJ existente
			header("Location: ../createAccount.php?type=user&term=yes&nomecompleto=".$_POST['nomecompleto']."&cpf=".$_POST['cpf']."&datanascimento=".$_POST['datanascimento']."&Sexo=".$_POST['Sexo']."&estadocivil=".$_POST['estadocivil']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefoneresidencial=".$_POST['telefoneresidencial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&preferenciaanimal=".$_POST['preferenciaanimal']."&tipomoradia=".$_POST['tipomoradia']."&adotouanimal=".$_POST['adotouanimal']."&email=".$_POST['email']."&erro=cpf");	
			
		}
		else if($checkEmail)
		{
			// Retorna para a página 'createAccount.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o Email existente
			header("Location: ../createAccount.php?type=user&term=yes&nomecompleto=".$_POST['nomecompleto']."&cpf=".$_POST['cpf']."&datanascimento=".$_POST['datanascimento']."&Sexo=".$_POST['Sexo']."&estadocivil=".$_POST['estadocivil']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefoneresidencial=".$_POST['telefoneresidencial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&preferenciaanimal=".$_POST['preferenciaanimal']."&tipomoradia=".$_POST['tipomoradia']."&adotouanimal=".$_POST['adotouanimal']."&email=".$_POST['email']."&erro=email");	

		}
		else
		{
			// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a criação da conta
			$novaConta = new UserAccount($email, $senha, 'OK', $endereco, $numero, $complemento, $cep, $bairro, $cidade, $estado, $telefonemovel, $idfacebook, $idtwitter, $cpf, $nomecompleto, $datanascimento, $sexo, $estadocivil, $tipomoradia, $preferenciaanimal, $adotouanimal, $telefoneresidencial);

			// Efetua a tentativa de criação da conta
			if($novaConta->createAccount())
			{
				// Envio de notificação de criação de conta
				sendEmail::newAccount($nomecompleto, $email);

				// Redireciona o usuário para a página de 'sucesso'
				header("Location: ../success.php?success=yes");
			}
			else
			{	
				// Caso haja algum erro na criação da conta (conexão com o BD)
				header("Location: ../createAccount.php?type=user&term=yes&nomecompleto=".$_POST['nomecompleto']."&cpf=".$_POST['cpf']."&datanascimento=".$_POST['datanascimento']."&Sexo=".$_POST['Sexo']."&estadocivil=".$_POST['estadocivil']."&cep=".$_POST['cep']."&endereco=".$_POST['endereco']."&numero=".$_POST['numero']."&complemento=".$_POST['complemento']."&bairro=".$_POST['bairro']."&cidade=".$_POST['cidade']."&estado=".$_POST['estado']."&telefoneresidencial=".$_POST['telefoneresidencial']."&telefonemovel=".$_POST['telefonemovel']."&idfacebook=".$_POST['idfacebook']."&idtwitter=".$_POST['idtwitter']."&preferenciaanimal=".$_POST['preferenciaanimal']."&tipomoradia=".$_POST['tipomoradia']."&adotouanimal=".$_POST['adotouanimal']."&email=".$_POST['email']."&erro=bd");
			}
;
		}

	break;

	default:
	
	header('Location: ../');
	
}
?>
