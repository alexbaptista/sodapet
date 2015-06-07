<?php
/*
 * Inclusão da classe GeneralInfo
 * Para obter informações como data/hora e Ip de origem
 */
include_once 'GeneralInfo.class.php';
/*
 * classe Animal
 * Esta classe abstrata provê uma interface utilizada para definição de dados para a criação de cadastros de animais
 */
abstract class Animal
{
	protected $emailAnimal;
	protected $idAnimal;
	protected $typeAnimal;
	protected $statusAnimal;
	protected $creationDateAnimal;
	protected $updateDateAnimal;
	protected $originIpCreationAnimal;
	
	/*
	* Método construtor
	* Constrõe a classe abstrata com as informações genéricas dos animais, sem tipo definido
	*/
	function __construct($emailAnimal, $idAnimal, $typeAnimal, $statusAnimal)
	{
		$Info = new GeneralInfo();
		$this->emailAnimal = $emailAnimal;
		$this->idAnimal = $idAnimal;
		$this->typeAnimal = $typeAnimal;
		$this->statusAnimal = $statusAnimal;
		$this->creationDateAnimal = $Info->getDatahora();
		$this->updateDateAnimal = $Info->getDatahora();
		$this->originIpCreationAnimal = $Info->getIpOrigem();
	}

	abstract function createAnimal();

	abstract function updateAnimal($SearchidAnimal);

}
?>
