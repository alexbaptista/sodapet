<?php
/* 
* Classe OperationAnimal
* Classe responsável pelas operações de consulta dos dados de animais.
*/
final class OperationAnimal
{
	private $emailSearch;
	private $typeId;
	private $idAnimal;
	private $statusAnimal;
	
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
			$sql->setEntity('dadosAnimais');

			// acrescenta colunas à consulta
			$sql->addColumn('MAX(idAnimal)');

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultSelect = $conn->query($sql->getInstruction());

			// escreve a mensagem de LOG
			STransaction::log("Consultando último ID de animal ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar último ID de animal ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
	
	/*
	* Método checkCountAnimals
	* Método responsável pela contabilização da quantidade de animais por ong e por obter quais os IDs
	*/	
	function checkCountAnimals($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

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
			STransaction::log("Consultando a quantidade de animais para esta Ong '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de animais para esta Ong '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
	
	/*
	* Método checkCountAnimalsDog
	* Método responsável pela contabilização da quantidade de animais por ong e por obter quais os IDs
	*/	
	function checkCountAnimalsDog($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));
			$criteria->add(new SFilter('tipoAnimal', '=', 'CAO'));
			$criteria->add(new SFilter('statusAnimal', '=', 'DISPONIVEL'));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

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
			STransaction::log("Consultando a quantidade de animais CAO para esta Ong '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de animais CAO para esta Ong '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}

	/*
	* Método checkCountAnimalsCat
	* Método responsável pela contabilização da quantidade de animais por ong e por obter quais os IDs
	*/	
	function checkCountAnimalsCat($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));
			$criteria->add(new SFilter('tipoAnimal', '=', 'GATO'));
			$criteria->add(new SFilter('statusAnimal', '=', 'DISPONIVEL'));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

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
			STransaction::log("Consultando a quantidade de animais GATO para esta Ong '" . $emailSearch. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetchAll();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar quantidade de animais GATO para esta Ong '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}

	/*
	* Método loadInfoAnimal
	* Método responsável pelo retorno das informações do animal pelo ID
	*/	
	function loadInfoAnimal($idAnimal)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// acrescenta colunas à consulta
			$sql->addColumn('tipoAnimal');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('Sem informações para este ID de animal');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Localizando informações para ID de animal (Tipo) '" . $idAnimal. "' ======> " . $sql->getInstruction());

			// armazena o resultado
			$animalType = $resultSelect->fetch();

			if($animalType[0] == 'CAO')
			{
				
				// cria critério de seleção de dados
				$criteria2 = new SCriteria;
				$criteria2->add(new SFilter('idAnimal', '=', $idAnimal));

				// cria instrução de SELECT
				$sql2 = new SSqlSelect;

				// define o nome da entidade
				$sql2->setEntity('dadosAnimaisCao');

				// acrescenta colunas à consulta
				$sql2->addColumn('idAnimal');
				$sql2->addColumn('nomeAnimal');
				$sql2->addColumn('racaAnimal');
				$sql2->addColumn('sexoAnimal');
				
				// define o critério de seleção de dados
				$sql2->setCriteria($criteria2);

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));
			
				// executa a instrução SQL
				$finalResultSelect = $conn->query($sql2->getInstruction());
				
				// escreve a mensagem de LOG
				STransaction::log("Localizando informações para ID de animal '" . $idAnimal. "' ======> " . $sql2->getInstruction());				
			
			}
			else
			{
				
				// cria critério de seleção de dados
				$criteria2 = new SCriteria;
				$criteria2->add(new SFilter('idAnimal', '=', $idAnimal));

				// cria instrução de SELECT
				$sql2 = new SSqlSelect;

				// define o nome da entidade
				$sql2->setEntity('dadosAnimaisGato');

				// acrescenta colunas à consulta
				$sql2->addColumn('idAnimal');
				$sql2->addColumn('nomeAnimal');
				$sql2->addColumn('racaAnimal');
				$sql2->addColumn('sexoAnimal');
				
				// define o critério de seleção de dados
				$sql2->setCriteria($criteria2);

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));
			
				// executa a instrução SQL
				$finalResultSelect = $conn->query($sql2->getInstruction());
				
				// escreve a mensagem de LOG
				STransaction::log("Localizando informações para ID de animal '" . $idAnimal. "' ======> " . $sql2->getInstruction());				
				
			}

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			// Armazenamento do retorno
			$infoReturn = $finalResultSelect->fetch();
			
			//Concatenação das informações
			$infoReturn[4] = $animalType[0];
			
			return $infoReturn;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao localizar informações para ID de animal '" . $idAnimal . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
	
	/*
	* Método loadInfoAnimalEdit
	* Método responsável pelo retorno das informações do animal pelo ID
	*/	
	function loadInfoAnimalEdit($idAnimal)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// acrescenta colunas à consulta
			$sql->addColumn('tipoAnimal');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('Sem informações para este ID de animal');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Localizando informações para ID de animal (Tipo) '" . $idAnimal. "' ======> " . $sql->getInstruction());

			// armazena o resultado
			$animalType = $resultSelect->fetch();

			if($animalType[0] == 'CAO')
			{
				
				// cria critério de seleção de dados
				$criteria2 = new SCriteria;
				$criteria2->add(new SFilter('idAnimal', '=', $idAnimal));

				// cria instrução de SELECT
				$sql2 = new SSqlSelect;

				// define o nome da entidade
				$sql2->setEntity('dadosAnimaisCao');

				// acrescenta colunas à consulta
				$sql2->addColumn('*');
				
				// define o critério de seleção de dados
				$sql2->setCriteria($criteria2);

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));
			
				// executa a instrução SQL
				$finalResultSelect = $conn->query($sql2->getInstruction());
				
				// escreve a mensagem de LOG
				STransaction::log("Localizando informações para ID de animal '" . $idAnimal. "' ======> " . $sql2->getInstruction());				
			
			}
			else
			{
				
				// cria critério de seleção de dados
				$criteria2 = new SCriteria;
				$criteria2->add(new SFilter('idAnimal', '=', $idAnimal));

				// cria instrução de SELECT
				$sql2 = new SSqlSelect;

				// define o nome da entidade
				$sql2->setEntity('dadosAnimaisGato');

				// acrescenta colunas à consulta
				$sql2->addColumn('*');
				
				// define o critério de seleção de dados
				$sql2->setCriteria($criteria2);

				// define a estratégia de LOG
				STransaction::setLogger(new SLoggerTXT('OPERATION'));
			
				// executa a instrução SQL
				$finalResultSelect = $conn->query($sql2->getInstruction());
				
				// escreve a mensagem de LOG
				STransaction::log("Localizando informações para ID de animal '" . $idAnimal. "' ======> " . $sql2->getInstruction());				
				
			}

			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			// Armazenamento do retorno
			$infoReturn = $finalResultSelect->fetch();
			
			//Concatenação das informações
			$infoReturn[21] = $animalType[0];
			
			return $infoReturn;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao localizar informações para ID de animal '" . $idAnimal . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
	
	function checkAnimalID($emailSearch, $idAnimal)
	{	
		try
		{		
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// acrescenta colunas à consulta
			$sql->addColumn('emailConta');
			
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
			STransaction::log("Verificando se animal pertence ao usuário (".$emailSearch.") = (".$idAnimal.") ======> " . $sql->getInstruction());

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
			STransaction::log("Erro ao verificar se animal pertence ao usuário (".$emailSearch.") = (".$idAnimal.") ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}		
	
	}
	
	/*
	* Método deleteAnimal
	* Método responsável exclusão de uma animal na base de dados
	*/	
	function deleteAnimal($idAnimal)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria instrução de DELETE
			$sql = new SSqlDelete;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');
			
			// define o critério de seleção de dados
			$sql->setCriteria($criteria);
			
			// abre uma transação
			STransaction::open('mysql');
			
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultDelete = $conn->query($sql->getInstruction());

			// Verifica se houve sucesso na consulta
			if($resultDelete->rowCount() == 0)
			{
				throw new Exception ('animal não localizado');
			}
						
			// escreve a mensagem de LOG
			STransaction::log("Excluindo animal #'" . $idAnimal. "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return true;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao excluir o animal #'" . $idAnimal. "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}	
	}
	
	/*
	* Método infoOngAnimal
	* Método responsável pela consulta de qual Ong pertence o animal
	*/		
	function infoOngAnimal($idAnimal)
	{	
		try
		{		
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

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
			STransaction::log("Verificando a quem pertence o animal (".$idAnimal.") ======> " . $sql->getInstruction());

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
			STransaction::log("Erro ao verificar á quem pertence o animal (".$emailSearch.") = (".$idAnimal.") ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}		
	}
	
	/*
	* Método updateAnimalStatus
	* Método responsável pela atualização do status do animal
	* @param emailSearch = Email á ser atualizado com as informações no método construtor
	*/
	public function updateAnimalStatus($idAnimal, $statusAnimal)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $idAnimal));

			// cria uma instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// atribui o valor de cada coluna
			$sql->setRowData('statusAnimal', $statusAnimal);

			// define o critério de seleção de dados
			$sql->setCriteria($criteria);
	
			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->exec($sql->getInstruction());
		
			// escreve a mensagem de LOG
			STransaction::log("Atualizando animal #". $idAnimal ." ======> " . $sql->getInstruction());
		
			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch (Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro atualizar animal  #". $idAnimal ." ======>" . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
