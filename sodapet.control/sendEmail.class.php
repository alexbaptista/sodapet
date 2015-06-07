<?php
/*
* classe sendEmail
* Classe para envio de notificações aos clientes sodapet.org
*/

final class sendEmail
{
	private $infoUser;
	private $emailUser;
	private $idTicket;

	/*
	* método newAccount
	* Método de envio de notificações para novas contas
	* @infoUser = Informações do usuário
	*/
	function newAccount($infoUser, $emailUser)
	{
 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$emailsender		= "info@sodapet.org";
		$quebra_linha		= "\n";
		$nomeremetente		= "SODAPET";
		$emaildestinatario	= $emailUser;
		$comcopia		= "";
		$comcopiaoculta		= "webmaster@sodapet.org";
		$assunto		= "Seja Bem Vindo !";
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = "<table style=\"font-size: 12px; color: #958e89; text-align: center; font-family:Helvetica Neue, Arial, Helvetica, sans-serif;\" align=\"center\" width=\"640px\" height=\"480px\" background=\"http://sodapet.org/sodapet.images/background_email.png\">
		<tr>
		<td>
		<br />
		<br />
		<h1><b>Bem Vindo,</b></h1>
		<br />
		<h1 style=\"color: black;\"><b>".$infoUser."</b></h1>
		<br />
		<h3>Agradecemos pela criação de uma conta no nosso sistema !</h3>
		<br />
		<h3><b>Atenciosamente,</b></h3>
		<h3><b>Equipe SóDáPet</b></h3>
		</td>
		</tr>
		</table>";
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$nomeremetente." <".$emailsender.">".$quebra_linha;
		
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailsender.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

		// Enviando a mensagem
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
		
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('OPERATION'));

		// escreve a mensagem de LOG
		STransaction::log("Envio de notificação de criação de conta '" . $emailUser . "' ======> " . $emaildestinatario . "==" . $assunto . "==" . $headers . "==" . $emailsender);

		// fecha a transação, aplicando todas as operações
		STransaction::close();
	}
	
	/*
	* método newTicketOng
	* Método de envio de notificações para novas contas
	* @infoUser = Informações do usuário
	*/
	function newTicketOng($infoUser, $emailUser)
	{
 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$emailsender		= "info@sodapet.org";
		$quebra_linha		= "\n";
		$nomeremetente		= "SODAPET";
		$emaildestinatario	= $emailUser;
		$comcopia		= "";
		$comcopiaoculta		= "webmaster@sodapet.org";
		$assunto		= "SóDáPet - Nova solicitação de adoção";
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = "<table style=\"font-size: 12px; color: #958e89; text-align: center; font-family:Helvetica Neue, Arial, Helvetica, sans-serif;\" align=\"center\" width=\"640px\" height=\"480px\" background=\"http://sodapet.org/sodapet.images/background_email.png\">
		<tr>
		<td>
		<br />
		<br />
		<br />
		<h1><b>Prezado !</b></h1>
		<br />
		<h3>Foi registrada uma nova solicitação de adoção para o animal:</h3>
		<br />
		<h1 style=\"color: black;\"><b>".$infoUser."</b></h1>
		<br />
		<h3>O pedido está pendente de sua análise.</h3>
		<br />
		<h3><b>Atenciosamente,</b></h3>
		<h3><b>Equipe SóDáPet</b></h3>
		</td>
		</tr>
		</table>";
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$nomeremetente." <".$emailsender.">".$quebra_linha;
		
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailsender.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

		// Enviando a mensagem
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
		
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('OPERATION'));

		// escreve a mensagem de LOG
		STransaction::log("Envio de notificação de criação de ticket ong '" . $emailUser . "' ======> " . $emaildestinatario . "==" . $assunto . "==" . $headers . "==" . $emailsender);

		// fecha a transação, aplicando todas as operações
		STransaction::close();
	}
	
	/*
	* método newTicketUser
	* Método de envio de notificações para novas contas
	* @infoUser = Informações do usuário
	*/
	function newTicketUser($infoUser, $emailUser)
	{
 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$emailsender		= "info@sodapet.org";
		$quebra_linha		= "\n";
		$nomeremetente		= "SODAPET";
		$emaildestinatario	= $emailUser;
		$comcopia		= "";
		$comcopiaoculta		= "webmaster@sodapet.org";
		$assunto		= "SóDáPet - Solicitação de adoção realizada com sucesso !";
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = "<table style=\"font-size: 12px; color: #958e89; text-align: center; font-family:Helvetica Neue, Arial, Helvetica, sans-serif;\" align=\"center\" width=\"640px\" height=\"480px\" background=\"http://sodapet.org/sodapet.images/background_email.png\">
		<tr>
		<td>
		<br />
		<br />
		<br />
		<h1><b>Prezado !</b></h1>
		<br />
		<h3>Registramos com sucesso a solicitação de adoção para o animal:</h3>
		<br />
		<h1 style=\"color: black;\"><b>".$infoUser."</b></h1>
		<br />
		<h3>Quando analisado o pedido, você será notificado em um novo e-mail !</h3>
		<br />
		<h3><b>Atenciosamente,</b></h3>
		<h3><b>Equipe SóDáPet</b></h3>
		</td>
		</tr>
		</table>";
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$nomeremetente." <".$emailsender.">".$quebra_linha;
		
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailsender.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

		// Enviando a mensagem
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
		
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('OPERATION'));

		// escreve a mensagem de LOG
		STransaction::log("Envio de notificação de criação de ticket usuário '" . $emailUser . "' ======> " . $emaildestinatario . "==" . $assunto . "==" . $headers . "==" . $emailsender);

		// fecha a transação, aplicando todas as operações
		STransaction::close();
	}
	
	/*
	* método updateTicket
	* Notificação de atualização para os usuários
	* @infoUser = Informações do usuário
	*/	
	function updateTicket($infoUser, $emailUser, $idTicket)
	{
 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$emailsender		= "info@sodapet.org";
		$quebra_linha		= "\n";
		$nomeremetente		= "SODAPET";
		$emaildestinatario	= $emailUser;
		$comcopia		= "";
		$comcopiaoculta		= "webmaster@sodapet.org";
		$assunto		= "SóDáPet - Atualização do Ticket #".$idTicket."";
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = "<table style=\"font-size: 12px; color: #958e89; text-align: center; font-family:Helvetica Neue, Arial, Helvetica, sans-serif;\" align=\"center\" width=\"640px\" height=\"480px\" background=\"http://sodapet.org/sodapet.images/background_email.png\">
		<tr>
		<td>
		<br />
		<br />
		<br />
		<h1><b>Prezado !</b></h1>
		<br />
		<h3>Houve uma atualização no processo de adoção:</h3>
		<br />
		<h1 style=\"color: black;\"><b>".$infoUser."</b></h1>
		<br />
		<h3>Quando houver uma nova atualização, você será notificado em um novo e-mail !</h3>
		<br />
		<h3><b>Atenciosamente,</b></h3>
		<h3><b>Equipe SóDáPet</b></h3>
		</td>
		</tr>
		</table>";
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$nomeremetente." <".$emailsender.">".$quebra_linha;
		
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailsender.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

		// Enviando a mensagem
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
		
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('OPERATION'));

		// escreve a mensagem de LOG
		STransaction::log("Envio de notificação de atualização do ticket'" . $emailUser . "' ======> " . $emaildestinatario . "==" . $assunto . "==" . $headers . "==" . $emailsender);

		// fecha a transação, aplicando todas as operações
		STransaction::close();
	}
	
	/*
	* método updateTicket
	* Notificação de atualização para os usuários
	* @infoUser = Informações do usuário
	*/		
	function okayTicket($infoUser, $emailUser, $idTicket)
	{
 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$emailsender		= "info@sodapet.org";
		$quebra_linha		= "\n";
		$nomeremetente		= "SODAPET";
		$emaildestinatario	= $emailUser;
		$comcopia		= "";
		$comcopiaoculta		= "webmaster@sodapet.org";
		$assunto		= "SóDáPet - Atualização do Ticket #".$idTicket."";
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = "<table style=\"font-size: 12px; color: #958e89; text-align: center; font-family:Helvetica Neue, Arial, Helvetica, sans-serif;\" align=\"center\" width=\"640px\" height=\"480px\" background=\"http://sodapet.org/sodapet.images/background_email.png\">
		<tr>
		<td>
		<br />
		<br />
		<br />
		<h1><b>Prezado !</b></h1>
		<br />
		<h3>Informamos que a Ong responsável pelo animal, aceitou o seu pedido de adoção, conforme descrição abaixo:</h3>
		<br />
		<h1 style=\"color: black;\"><b>".$infoUser."</b></h1>
		<br />
		<h3>Em breve a Ong responsável irá contatá-lo para definir os detalhes do processo</h3>
		<br />
		<h3><b>Atenciosamente,</b></h3>
		<h3><b>Equipe SóDáPet</b></h3>
		</td>
		</tr>
		</table>";
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		
		$headers .= "Content-type: text/html; charset=utf-8".$quebra_linha;
		
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$nomeremetente." <".$emailsender.">".$quebra_linha;
		
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		
		$headers .= "Reply-To: ".$emailsender.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

		// Enviando a mensagem
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);
		
		// define a estratégia de LOG
		STransaction::setLogger(new SLoggerTXT('OPERATION'));

		// escreve a mensagem de LOG
		STransaction::log("Envio de notificação de encerramento do ticket '" . $emailUser . "' ======> " . $emaildestinatario . "==" . $assunto . "==" . $headers . "==" . $emailsender);

		// fecha a transação, aplicando todas as operações
		STransaction::close();
	}
}
?>
