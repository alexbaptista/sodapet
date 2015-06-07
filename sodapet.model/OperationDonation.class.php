<?php
/* 
* Classe OperationDonation
* Classe responsável pelas operações de consulta dos dados de doação.
*/
final class OperationDonation
{
	private $typeId;
	private $emailSearch;
	private $idAnimal;
	private $idTicket;
	
	/*
	* Método getNextId
	* Método responsável pela obtenção do próximo ID disponível para inclusão no banco de dados
	*/
	function getLastId()
	{
		try
		{		
			// cria instrução de SELECT
			$sql = new SSqlSelect;
			
			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('MAX(idTicket)');

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());

			// escreve a mensagem de LOG
			STransaction::log("Consultando último ID de Ticket ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar último ID de Ticket ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
	
	/*
	* Método CountDonationOngDone
	* Método responsável pela contabilização da quantidade de doações concluídas por Ongs
	*/	
	function CountDonationOngDone($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailContaOng', '=', $emailSearch));
			$criteria->add(new SFilter('statusTicket', '=', 'APROVADO'));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('idAnimal');

			// abre uma transação
			STransaction::open('mysql');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando a quantidade de doações para esta ONG '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de doações para esta ONG '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}

	/*
	* Método CountDonationUser
	* Método responsável pela contabilização da quantidade de doações para o usuário
	*/	
	function CountDonationUser($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailContaUsuario', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('*');

			// abre uma transação
			STransaction::open('mysql');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando a quantidade de doações para este usuário '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de doações para este usuário '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}

	/*
	* Método CountDonationOng
	* Método responsável pela contabilização da quantidade de doações para a Ong
	*/	
	function CountDonationOng($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailContaOng', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('*');

			// abre uma transação
			STransaction::open('mysql');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando a quantidade de doações para esta Ong '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de doações para esta Ong '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
		
	/*
	* Método checkDonationUser
	* Método responsável pela verificação de doação em andamento por usuário
	*/	
	function checkDonationUser($idAnimal, $emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));
			$criteria->add(new SFilter('emailContaUsuario', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('*');

			// abre uma transação
			STransaction::open('mysql');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando a existência de um ticket deste animal para o usuário '" . $emailSearch. " == " . $idAnimal . " ' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao a existência de um ticket deste animal para o usuário '" . $emailSearch. " == " . $idAnimal . " ' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
	
	/*
	* Método checkTicketId
	* Método responsável pela verificação de quem pertence o Ticket
	*/		
	function checkTicketId($emailSearch, $idTicket)
	{	
		try
		{		
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idTicket', '=', $idTicket));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('emailContaOng');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);
			
			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());

			// escreve a mensagem de LOG
			STransaction::log("Verificando se o ticket pertence á Ong (".$emailSearch.") = (".$idTicket.") ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			// Verifica o resultado
			$infoReturn = $resultSelect->fetch();
			
			// Verifica se o animal pertence á ONG X
			if($infoReturn[0] == $emailSearch)
			{
				return true;				
			}
			else
			{
				return false;
			}
					
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao verificar se o ticket pertence á Ong (".$emailSearch.") = (".$idTicket.") ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}		
	
	}
	
	/*
	* Método loadInfoTicket
	* Método responsável pela busca de informações de um ticket específico
	*/		
	function loadInfoTicket($idTicket)
	{	
		try
		{		
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idTicket', '=', $idTicket));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('*');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);
			
			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());

			// escreve a mensagem de LOG
			STransaction::log("Localizando informações do ticket #".$idTicket." ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			// Verifica o resultado
			return $resultSelect->fetchAll();
					
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao localizar informações do ticket #".$idTicket." ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}		
	
	}
	
	/*
	* Método loadInfoTicketAnimaltoClose
	* Método responsável pela busca de informações de um ticket específico
	*/		
	function loadInfoTicketAnimaltoClose($idAnimal, $emailSearch)
	{	
		try
		{		
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));
			$criteria->add(new SFilter('emailContaOng', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAdocao');

			// acrescenta colunas à consulta
			$sql->addColumn('idTicket');
			$sql->addColumn('statusTicket');
			$sql->addColumn('emailContaUsuario');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);
			
			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());

			// escreve a mensagem de LOG
			STransaction::log("Localizando informações do ticket para o animal #".$idAnimal." ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			// Verifica o resultado
			return $resultSelect->fetchAll();
					
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao localizar informações do ticket para o animal #".$idAnimal." ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}		
	
	}
}
?>
