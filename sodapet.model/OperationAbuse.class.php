<?php
/* 
* Classe OperationAbuse
* Classe responsável pelas operações de consulta dos dados de Ticket.
*/
final class OperationAbuse
{
	private $typeId;
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
			$sql->setEntity('dadosAbuse');

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
			STransaction::log("Consultando último ID de Ticket ABUSE ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar último ID de Ticket ABUSE ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
