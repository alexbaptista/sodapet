<?php
/* 
* Classe processUpdateTicket
* Classe responsável pelo recebimento das informações por POST para a atualização dos Tickets
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

// Resgata os valores das variaveis
$idTicket = $_POST['idticket'];
$statusTicket = $_POST['status'];
$descricaoTicket = $_POST['descricao'];
$emailOng = $_POST['emailong'];

// Verifica se as variaveis tem algum conteúdo
if(isset($idTicket) || isset($statusTicket) || isset($descricaoTicket) || isset($emailOng))
{
	// Verifica se há sessão ativa
	if (isset($_SESSION['tipo']))
	{
		switch($_SESSION['tipo'])
		{

			case 'ONG':
			
				// Verifica á quem pertence o Ticket
				$verificaOrigemTicket = OperationDonation::checkTicketId($_SESSION['info'][0], $idTicket);
				
				if($verificaOrigemTicket)
				{
					
					// verifica as informações do Ticket X
					$infoTicket = OperationDonation::loadInfoTicket($idTicket);
					
					if($infoTicket[0][4] != 'APROVADO' && $infoTicket[0][4] != 'CANCELADO')
					{
						
						//Instancia as informações para a atualização do ticket
						$updateTicket = new Donation();
						
						// Atualiza as informações do Ticket
						if($updateTicket->updateTicketOng($idTicket, $statusTicket, $descricaoTicket))
						{
							
							// Verifica se o status deste ticket é "APROVADO" para cancelar demais tickets para os outros animais
							if($statusTicket == 'APROVADO')
							{
								
								//Bloqueia o animal para novos pedidos
								OperationAnimal::updateAnimalStatus($infoTicket[0][1],'INDISPONIVEL');
								
								//Notificação por e-mail
								sendEmail::okayTicket($descricaoTicket, $infoTicket[0][3], $idTicket);
								
								// Verificando os demais tickets para serem fechados e os usuários notificados
								$ticketsToClose = OperationDonation::loadInfoTicketAnimaltoClose($infoTicket[0][1], $_SESSION['info'][0]);
																
								// percorre os tickets para serem fechados e finalizados
								for($i = 0; $i < count($ticketsToClose); $i++)
								{
										// Fecha os tickets e notifica os usuários da ação
										if($ticketsToClose[$i][1] != 'APROVADO')
										{
											// Instanciamento de objeto
											$closeTicket = new Donation();
											
											// fecha os tickets concorrentes
											$closeTicket->updateTicketOng($ticketsToClose[$i][0], 'CANCELADO', 'ONG OPTOU POR OUTRO USUARIO');
											
											//Notificação por e-mail
											sendEmail::updateTicket('A Ong responsável selecionou outro candidato', $ticketsToClose[$i][2], $ticketsToClose[$i][0]);											
											
										}
											
								}
	
								header("Location: ../donationEdit.php?ticket=$idTicket&statusticket=200");	
							}
							else
							{
								//Notificação por e-mail
								sendEmail::updateTicket($descricaoTicket, $infoTicket[0][3], $idTicket);
								
								header("Location: ../donationEdit.php?ticket=$idTicket&statusticket=200");	
							
							}
							
						}
						else
						{

							header("Location: ../donationEdit.php?ticket=$idTicket&statusticket=404");						
							
						}
						
					}
					else
					{
						
						header("Location: ../donationEdit.php?ticket=$idTicket&statusticket=500");						
						
					}
					
				}
				else
				{
					
					header('Location: ../adminDonations.php');
					
				}
				
			break;
			
			default:
			
				header('Location: ../adminDonations.php');	
							
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
