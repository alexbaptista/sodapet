<?php
/* 
* Classe OngAccount
* Classe responsável pela definição do tipo conta, herda características da class Account
*/
class OngAccount extends Account
{
	private $cnpjAccount;
	private $corporateNameAccount;
	private $fancyNameAccount;
	private $descriptionAccount;
	private $logoAccount;
	private $specialityAccount;
	private $businessTelephone;
	private $website;
	public $typeAccount = 'ONG';

	/*
	* Método construtor
	* Define as operações á serem realizadas
	*/
	public function __construct($emailAccount, $passwordAccount, $statusAccount, $addressAccount, $numberAddressAccount, $complementAddressAccount, $zipCodeAccount, $neighborhoodAccount, $cityAccount, $stateAccount, $mobileTelephoneAccount, $facebookIdAccount, $twitterIdAccount, $cnpjAccount, $corporateNameAccount, $fancyNameAccount, $descriptionAccount, $logoAccount, $specialityAccount, $businessTelephone, $website)
	{
		/*
		* Método construtor classe Pai
		*/
		parent::__construct($emailAccount, $this->typeAccount, $statusAccount, $passwordAccount, $addressAccount, $numberAddressAccount, $complementAddressAccount, $zipCodeAccount, $neighborhoodAccount, $cityAccount, $stateAccount, $mobileTelephoneAccount, $facebookIdAccount, $twitterIdAccount);
		$this->cnpjAccount = $cnpjAccount;
		$this->corporateNameAccount = $corporateNameAccount;
		$this->fancyNameAccount = $fancyNameAccount;
		$this->descriptionAccount = $descriptionAccount;
		$this->logoAccount = $logoAccount;
		$this->specialityAccount = $specialityAccount;
		$this->businessTelephone = $businessTelephone;
		$this->website = $website;
	}
	/*
	* Método createAccount
	* Responsável pela criação no banco de dados de uma conta do tipo "ONG"
	*/
	public function createAccount()
	{
		try
		{	
			// define o LOCALE do sistema, para permitir ponto decimal.
			setlocale(LC_NUMERIC, 'POSIX');

			// cria uma instrução de INSERT
			$sql = new SSqlInsert;

			// define o nome da entidade
			$sql->setEntity('dadosConta');

			// atribui o valor de cada coluna
			$sql->setRowData('emailConta', $this->emailAccount);
			$sql->setRowData('tipoConta', $this->typeAccount);
			$sql->setRowData('statusConta', $this->statusAccount);
			$sql->setRowData('senhaConta', $this->passwordAccount);
			$sql->setRowData('dataCriacaoConta', $this->creationDateAccount);
			$sql->setRowData('ultimaAtualizacaoConta', $this->updateDateAccount);
			$sql->setRowData('ipOrigemCriacaoConta', $this->originIpCreationAccount);
			
			// cria uma instrução de INSERT
			$sqlComplement = new SSqlInsert;

			// cria uma instrução de INSERT
			$sqlComplement->setEntity('dadosContaOng');

			// atribui o valor de cada coluna
			$sqlComplement->setRowData('emailConta', $this->emailAccount);
			$sqlComplement->setRowData('cnpj', $this->cnpjAccount);
			$sqlComplement->setRowData('razaoSocial', $this->corporateNameAccount);
                        $sqlComplement->setRowData('nomeFantasia', $this->fancyNameAccount);
			$sqlComplement->setRowData('descricao', $this->descriptionAccount);
			$sqlComplement->setRowData('logotipo', $this->logoAccount);
			$sqlComplement->setRowData('especialidade', $this->specialityAccount);
			$sqlComplement->setRowData('endereco', $this->addressAccount);
			$sqlComplement->setRowData('enderecoNumero', $this->numberAddressAccount);
			$sqlComplement->setRowData('enderecoComplemento', $this->complementAddressAccount);
			$sqlComplement->setRowData('cep', $this->zipCodeAccount);
			$sqlComplement->setRowData('bairro', $this->neighborhoodAccount);
			$sqlComplement->setRowData('cidade', $this->cityAccount);
			$sqlComplement->setRowData('estado', $this->stateAccount);
			$sqlComplement->setRowData('telefoneComercial', $this->businessTelephone);
			$sqlComplement->setRowData('telefoneMovel', $this->mobileTelephoneAccount);
			$sqlComplement->setRowData('idFacebook', $this->facebookIdAccount);
			$sqlComplement->setRowData('idTwitter', $this->twitterIdAccount);
			$sqlComplement->setRowData('website', $this->website);
			$sqlComplement->setRowData('urlPerfilOng', 'TESTE');
		
			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->query($sql->getInstruction());
			$conn->query($sqlComplement->getInstruction());
		
			// escreve a mensagem de LOG
			STransaction::log("Criando conta '" . $this->emailAccount . "' ======> " . $sql->getInstruction());
			STransaction::log("Criando conta Ong '" . $this->emailAccount . "' ======> " . $sqlComplement->getInstruction());
			STransaction::log("Criada conta Ong '" . $this->emailAccount . "'");
		
			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch (Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro criar conta '" . $this->emailAccount . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método updateAccount
	* Método responsável pela atualização de uma conta do tipo Ong
	* @param emailSearch = Email á ser atualizado com as informações no método construtor
	*/
	public function updateAccount($emailSearch)
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
			$sql->setRowData('emailConta', $this->emailAccount);
			$sql->setRowData('statusConta', $this->statusAccount);
			$sql->setRowData('senhaConta', $this->passwordAccount);
			$sql->setRowData('ultimaAtualizacaoConta', $this->updateDateAccount);

			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// cria critério de seleção de dados
			$criteria1 = new SCriteria;
			$criteria1->add(new SFilter('emailConta', '=', $this->emailAccount));

			// cria uma instrução de UPDATE
			$sqlComplement = new SSqlUpdate;

			// cria uma instrução de UPDATE
			$sqlComplement->setEntity('dadosContaOng');

			// atribui o valor de cada coluna
			$sqlComplement->setRowData('cnpj', $this->cnpjAccount);
			$sqlComplement->setRowData('razaoSocial', $this->corporateNameAccount);
			$sqlComplement->setRowData('nomeFantasia', $this->fancyNameAccount);
			$sqlComplement->setRowData('descricao', $this->descriptionAccount);
			$sqlComplement->setRowData('logotipo', $this->logoAccount);
			$sqlComplement->setRowData('especialidade', $this->specialityAccount);
			$sqlComplement->setRowData('endereco', $this->addressAccount);
			$sqlComplement->setRowData('enderecoNumero', $this->numberAddressAccount);
			$sqlComplement->setRowData('enderecoComplemento', $this->complementAddressAccount);
			$sqlComplement->setRowData('cep', $this->zipCodeAccount);
			$sqlComplement->setRowData('bairro', $this->neighborhoodAccount);
			$sqlComplement->setRowData('cidade', $this->cityAccount);
			$sqlComplement->setRowData('estado', $this->stateAccount);
			$sqlComplement->setRowData('telefoneComercial', $this->businessTelephone);
			$sqlComplement->setRowData('telefoneMovel', $this->mobileTelephoneAccount);
			$sqlComplement->setRowData('idFacebook', $this->facebookIdAccount);
			$sqlComplement->setRowData('idTwitter', $this->twitterIdAccount);
			$sqlComplement->setRowData('website', $this->website);
			$sqlComplement->setRowData('urlPerfilOng', 'TESTE');			
			
			// define o critério de seleção de dados
			$sqlComplement->setCriteria($criteria1);

			// abre uma transação
			STransaction::open('mysql');

			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('OPERATION'));

			// abre conexão com a base sodapet (mysql)
			$conn = STransaction::get();
		
			// executa a instrução SQL
			$conn->exec($sql->getInstruction());
			$conn->exec($sqlComplement->getInstruction());
			
			// escreve a mensagem de LOG
			STransaction::log("Atualizando conta '" . $emailSearch . "' ======> " . $sql->getInstruction());
			STransaction::log("Atualizando conta '" . $emailSearch . "' ======> " . $sqlComplement->getInstruction());
			STransaction::log("Atualizada conta Ong '" . $emailSearch . "'");
		
			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
	
		}
		catch (Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro ao atualizar conta '" . $emailSearch . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
