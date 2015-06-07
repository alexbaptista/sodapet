<?php
/* 
* Classe processAdoptionRegister
* Classe responsável pelo recebimento das informações por POST para a criação dos animais
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

// Inclusão da classe de envio de e-mail
include 'sendEmail.class.php';

//Resgata os valores das variáveis
$idAnimal = $_POST['idanimal'];
$emailOng = $_POST['emailong'];
$emailUser = $_POST['emailuser'];
$motivoUser = $_POST['descricao'];

// Verifica se as variaveis tem algum conteúdo
if(isset($idAnimal) || isset($emailOng) || isset($emailUser) || isset($motivoUser))
{
	
	// Verifica se há sessão ativa
	if (isset($_SESSION['tipo']))
	{
	
		switch($_SESSION['tipo'])
		{
			case 'USUARIO':
				
				// Instanciando as informações para a criação do Ticket
				$newDonation = new Donation();
				
				// Verifica se o ticket foi criado
				if($newDonation->createTicket($idAnimal, $emailOng, $emailUser, $motivoUser))
				{
					// Carrega as informações do animal
					$infoAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimal);
					
					// Envio de notificação de criação de conta
					sendEmail::newTicketOng($infoAnimal[1], $emailOng);

					// Envio de notificação de criação de conta
					sendEmail::newTicketUser($infoAnimal[1], $emailUser);
										
					header("Location: ../adminDonations.php?info=200");
					
				}
				else
				{
					header("Location: ../adoptionRegister.php?idanimal=$idAnimal&erro=bd");
					
				}
				
			
			break;
			
			case 'ONG':
			
				header('Location: ../adminPetsRegistered.php?statusaction=500');
			
			break;
			
			default:
			
				header('Location: ../index.php');
					
			break;
		}
	
	}
	else
	{

		header('Location: ../index.php');
		
	}
	
}
else
{
	
	header('Location: ../index.php');
	
}
?>
