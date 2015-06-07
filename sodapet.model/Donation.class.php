<?php
/* 
* Classe Donation
* Classe responsável pelo gerenciamento do processo de doação
*/
class Donation
{
	private $ticketId;
	private $animalId;
	private $emailOngAccount;
	private $emailUserAccount;
	private $statusTicket;
	private $creationDateTicket;
	private $reasonOng;
	private $reasonUser;
	private $updateDateTicket;
	private $originIpCreationTicket;
	
	/*
	* Método createTicket
	* Método responsável pela criação do ticket
	*/
	public function createTicket($animalId, $emailOngAccount, $emailUserAccount, $reasonUser)
	{
		try
		{
			//Obtém informações como data/hora e IP de origem
			$Info = new GeneralInfo();
			$this->creationDateTicket = $Info->getDatahora();
			$this->updateDateTicket = $Info->getDatahora();
			$this->originIpCreationTicket = $Info->getIpOrigem();

			// define o LOCALE do sistema, para permitir ponto decimal.
			setlocale(LC_NUMERIC, 'POSIX');

			// Obtém a informação do último ID do Ticket
			$getTicketId = OperationDonation::getLastId();
			$ticketId = $getTicketId[0] + 1;

			// cria uma instrução de INSERT
			$sql = new SSqlInsert;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// atribui o valor de cada coluna
			$sql->setRowData('idTicket', $ticketId);
			$sql->setRowData('idAnimal', $animalId);
			$sql->setRowData('emailContaOng', $emailOngAccount);
			$sql->setRowData('emailContaUsuario', $emailUserAccount);
			$sql->setRowData('statusTicket', 'PENDENTE');
			$sql->setRowData('dataCriacaoTicket', $this->creationDateTicket);
			$sql->setRowData('MotivoOng', '');
			$sql->setRowData('MotivoUsuario', $reasonUser);
			$sql->setRowData('ultimaAtualizacaoTicket', $this->updateDateTicket);
			$sql->setRowData('ipOrigemCriacaoTicket', $this->originIpCreationTicket);

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->query($sql->getInstruction());
		
			// escreve a mensagem de LOG
			STransaction::log("Criando ticket '". $ticketId . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro criar Ticket '". $ticketId . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
	
	/*
	* Método updateTicketOng
	* Método responsável pela atualização do ticket
	*/
	public function updateTicketOng($ticketId, $statusTicket, $reasonOng)
	{
		try
		{
			//Obtém informações como data/hora e IP de origem
			$Info = new GeneralInfo();
			$this->updateDateTicket = $Info->getDatahora();

			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idTicket', '=', $ticketId));

			// cria uma instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// atribui o valor de cada coluna
			$sql->setRowData('statusTicket', $statusTicket);
			$sql->setRowData('MotivoOng', $reasonOng);
			$sql->setRowData('ultimaAtualizacaoTicket', $this->updateDateTicket);

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
			STransaction::log("Atualizando ticket ONG '". $ticketId . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro atualizar Ticket ONG '". $ticketId . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método updateTicketUser
	* Método responsável pela atualização do ticket
	*/
	public function updateTicketUser($ticketId, $statusTicket, $reasonUser)
	{
		try
		{
			//Obtém informações como data/hora e IP de origem
			$Info = new GeneralInfo();
			$this->updateDateTicket = $Info->getDatahora();

			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idTicket', '=', $ticketId));

			// cria uma instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// atribui o valor de cada coluna
			$sql->setRowData('statusTicket', $statusTicket);
			$sql->setRowData('MotivoUsuario', $reasonUser);
			$sql->setRowData('ultimaAtualizacaoTicket', $this->updateDateTicket);
			
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
			STransaction::log("Atualizando ticket USER '". $ticketId . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro atualizar Ticket USER '". $ticketId . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
