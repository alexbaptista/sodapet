<?php
/*
 * Inclusão da classe GeneralInfo
 * Para obter informações como data/hora e Ip de origem
 */
include_once 'GeneralInfo.class.php';
/*
 * classe Account
 * Esta classe abstrata provê uma interface utilizada para definição de dados para a criação de contas
 */
abstract class Account
{
	protected $emailAccount;
	protected $typeAccount;
	protected $statusAccount;
	protected $passwordAccount;
	protected $creationDateAccount;
	protected $updateDateAccount;
	protected $originIpCreationAccount;
	protected $addressAccount;
	protected $numberAddressAccount;
	protected $complementAddressAccount;
	protected $zipCodeAccount;
	protected $neighborhoodAccount;
	protected $cityAccount;
	protected $stateAccount;
	protected $mobileTelephoneAccount;
	protected $facebookIdAccount;
	protected $twitterIdAccount;
	
	/*
	* Método construtor
	* Constrõe a classe abstrata com as informações genéricas de conta, sem tipo definido
	*/
	function __construct($emailAccount, $typeAccount, $statusAccount, $passwordAccount, $addressAccount, $numberAddressAccount, $complementAddressAccount, $zipCodeAccount, $neighborhoodAccount, $cityAccount, $stateAccount, $mobileTelephoneAccount, $facebookIdAccount, $twitterIdAccount)
	{
		$Info = new GeneralInfo();

		$this->emailAccount = $emailAccount;
		$this->typeAccount = $typeAccount;
		$this->statusAccount = $statusAccount;
		$this->passwordAccount = md5($passwordAccount);
		$this->creationDateAccount = $Info->getDatahora();
		$this->updateDateAccount = $Info->getDatahora();
		$this->originIpCreationAccount = $Info->getIpOrigem();
		$this->addressAccount = $addressAccount;
		$this->numberAddressAccount = $numberAddressAccount;
		$this->complementAddressAccount = $complementAddressAccount;
		$this->zipCodeAccount = $zipCodeAccount;
		$this->neighborhoodAccount = $neighborhoodAccount;
		$this->cityAccount = $cityAccount;
		$this->stateAccount = $stateAccount;
		$this->mobileTelephoneAccount = $mobileTelephoneAccount;
		$this->facebookIdAccount = $facebookIdAccount;
		$this->twitterIdAccount = $twitterIdAccount;	
	}

	abstract function createAccount();

	abstract function updateAccount($emailSearch);

}
?>
