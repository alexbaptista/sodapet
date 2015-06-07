<?php
/*
* Classe Abuse
* Classe responsável pelas operações de abuso em relação á usuários e animais
*/
class Abuse
{
	private $ticketId;
	private $emailId;
	private $typeAbuse;
	private $ticketStatus;
	private $descriptionAbuse;
	private $descriptionAbuseAdmin;
	private $dateCreationTicketAbuse;
	private $lastUpdateAbuse;
	private $ipCreationTicketAbuse;

	/*
	* Método createTicket
	* Método para a criação de tickets de abuso de ongs/animais
	*/
	public function createTicket($emailId, $typeAbuse, $descriptionAbuse)
	{
		try
		{
			//Obtém informações como data/hora e IP de origem
			$Info = new GeneralInfo();
			$this->dateCreationTicketAbuse = $Info->getDatahora();
			$this->lastUpdateAbuse = $Info->getDatahora();
			$this->ipCreationTicketAbuse = $Info->getIpOrigem();

			// define o LOCALE do sistema, para permitir ponto decimal.
			setlocale(LC_NUMERIC, 'POSIX');

			// Obtém a informação do último ID do Ticket
			$getTicketId = OperationAbuse::getLastId();
			$ticketId = $getTicketId[0] + 1;

			// cria uma instrução de INSERT
			$sql = new SSqlInsert;

			// define o nome da entidade
			$sql->setEntity('dadosAbuse');

			// atribui o valor de cada coluna
			$sql->setRowData('idTicket', $ticketId);
			$sql->setRowData('idEmail', $emailId);
			$sql->setRowData('tipoAbuse', $typeAbuse);
			$sql->setRowData('statusTicket', 'PENDENTE');
			$sql->setRowData('descricaoAbuse', $descriptionAbuse);
			$sql->setRowData('descricaoAdminSodapet', '');
			$sql->setRowData('dataCriacaoTicket', $this->dateCreationTicketAbuse);
			$sql->setRowData('ultimaAtualizacaoTicket', $this->lastUpdateAbuse);
			$sql->setRowData('ipOrigemCriacaoTicket', $this->ipCreationTicketAbuse);

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->query($sql->getInstruction());
		
			// escreve a mensagem de LOG
			STransaction::log("Criando ticket ABUSE '". $ticketId . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro criar Ticket ABUSE '". $ticketId . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
	
	/*
	* Método updateTicket
	* Método responsável pela atualização dos dados dos tickets de abuse de usuário/ong
	*/
	public function updateTicket($ticketId, $ticketStatus, $descriptionAbuseAdmin)
	{
		try
		{
			//Obtém informações como data/hora e IP de origem
			$Info = new GeneralInfo();
			$this->lastUpdateAbuse = $Info->getDatahora();

			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idTicket', '=', $ticketId));

			// cria uma instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosAbuse');

			// atribui o valor de cada coluna
			$sql->setRowData('statusTicket', $ticketStatus);
			$sql->setRowData('descricaoAdminSodapet', $descriptionAbuseAdmin);
			$sql->setRowData('ultimaAtualizacaoTicket', $this->lastUpdateAbuse);

			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->query($sql->getInstruction());
		
			// escreve a mensagem de LOG
			STransaction::log("Atualizando ticket ABUSE '". $ticketId . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro atualizar Ticket ABUSE '". $ticketId . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
