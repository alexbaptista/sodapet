<?php
/* 
* Classe OperationAccount
* Classe responsável pelas operações de consulta nas contas do tipo 'ONG' e 'USUARIO'
*/
final class OperationAccount{

	private $emailSearch;
	private $newPassword;
	private $argument;
	
	/*
	* Método checkTypeAccount
	* Método responsável pela checagem do tipo de conta.
	* @param $emailSearch = Email da conta para a operação
	*/
	function checkTypeAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

			// acrescenta colunas à consulta
			$sql->addColumn('tipoConta');

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
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando tipo de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar tipo de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método checkStatusAccount
	* Método responsável pela checagem do status de conta.
	* @param $emailSearch = Email da conta para a operação
	*/	
	function checkStatusAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

			// acrescenta colunas à consulta
			$sql->addColumn('statusConta');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando status da conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar status da conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
	
	/*
	* Método checkPasswordAccount
	* Método responsável pela checagem da senha da conta.
	* @param $emailSearch = Email da conta para a operação
	*/
	function checkPasswordAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

			// acrescenta colunas à consulta
			$sql->addColumn('senhaConta');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando senha de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar senha de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método checkCnpj
	* Método responsável pela verificação da existência de um CNPJ
	* @param $argument = argumento para a busca
	*/
	function checkCnpj($argument)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('cnpj', '=', $argument));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosContaOng');

			// acrescenta colunas à consulta
			$sql->addColumn('cnpj');

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
				throw new Exception ('CNPJ não existente');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando existência de CNPJ '" . $argument . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar existência de CNPJ '" . $argument . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método checkCpf
	* Método responsável pela verificação da existência de um CPF
	* @param $argument = argumento para a busca
	*/
	function checkCpf($argument)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('cpf', '=', $argument));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosContaUsuario');

			// acrescenta colunas à consulta
			$sql->addColumn('cpf');

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
				throw new Exception ('CPF não existente');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando existência de CPF '" . $argument . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar existência de CPF '" . $argument . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método setNewPasswordAccount
	* Método responsável pela definição de uma nova senha de conta
	* @param $emailSearch = Email da conta para a operação
	* @param $newPassword = Valor da nova senha para ser atualizada
	*/
	function setNewPasswordAccount($emailSearch, $newPassword)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosConta');
			
			// atribui o valor de cada coluna
			$sql->setRowData('senhaConta', md5($newPassword));

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
			STransaction::log("Alterando senha de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return true;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao alterar senha de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método lockAccount
	* Método responsável pela bloqueio de uma conta
	* @param $emailSearch = Email da conta para a operação
	*/
	function lockAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosConta');
			
			// atribui o valor de cada coluna
			$sql->setRowData('statusConta', 'BLOQUEADO');

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
			STransaction::log("Alterando status de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return true;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao alterar status de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método unlockAccount
	* Método responsável pelo desbloqueio de uma conta
	* @param $emailSearch = Email da conta para a operação
	*/
	function unlockAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosConta');
			
			// atribui o valor de cada coluna
			$sql->setRowData('statusConta', 'OK');

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
			STransaction::log("Alterando status de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return true;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao alterar status de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método loadInfoAccount
	* Método responsável pela obtenção de dados da conta
	* @param $emailSearch = Email da conta para a operação
	*/
	function loadInfoAccount($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando dados de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar dados de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método loadInfoAccountOng
	* Método responsável pela obtenção de dados da conta do tipo ONG
	* @param $emailSearch = Email da conta para a operação
	*/
	function loadInfoAccountOng($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosContaOng');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando dados de conta Ong '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar dados de conta Ong '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método loadBrandOng
	* Método responsável pela obtenção do logotipo da Ong
	* @param $argument = CNPJ da ong
	*/
	function loadBrandOng($argument)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('cnpj', '=', $argument));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosContaOng');

			// acrescenta colunas à consulta
			$sql->addColumn('logotipo');

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
				throw new Exception ('Logo não encontrado');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Carregando logo Ong '" . $argument . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao carregar logo Ong '" . $argument . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método loadInfoAccountUser
	* Método responsável pela obtenção de dados da conta do tipo USUARIO
	* @param $emailSearch = Email da conta para a operação
	*/
	function loadInfoAccountUser($emailSearch)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de SELECT
			$sql = new SSqlSelect;

			// define o nome da entidade
			$sql->setEntity('dadosContaUsuario');

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

			// Verifica se houve sucesso na consulta
			if($resultSelect->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Consultando dados de conta Usuario '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return $resultSelect->fetch();
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao consultar dados de conta Usuario '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método deleteAccount
	* Método para a deleção da uma conta
	* @param $emailSearch = Email da conta para a operação
	*/
	function deleteAccount($emailSearch)
	{

		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('emailConta', '=', $emailSearch));

			// cria instrução de DELETE
			$sql = new SSqlDelete;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

			// acrescenta colunas à consulta
			$sql->setCriteria($criteria);

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$resultDelete = $conn->Query($sql->getInstruction());

			// Verifica se houve sucesso na consulta
			if($resultDelete->rowCount() == 0)
			{
				throw new Exception ('conta não localizada');
			}
			
			// escreve a mensagem de LOG
			STransaction::log("Deletando dados de conta '" . $emailSearch . "' ======> " . $sql->getInstruction());

			// fecha a transação, aplicando todas as operações
			STransaction::close();
		
			return true;
			
		}
		catch(Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao deletar dados de conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
