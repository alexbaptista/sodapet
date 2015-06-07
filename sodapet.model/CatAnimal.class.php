<?php
/* 
* Classe CatAnimal
* Classe responsável pela definição do tipo de animal, herda características da class Animal
*/
class CatAnimal extends Animal
{

	private $nameAnimal;
	private $raceAnimal;
	private $genderAnimal;
	private $ageAnimal;
	private $sizeAnimal;
	private $weightAnimal;
	private $deficientAnimal;
	private $deficiencyAnimal;
	private $vaccinatedAnimal;
	private $castratedAnimal;
	private $descriptionAnimal;
	private $imageAnimal1;
	private $imageAnimal2;
	private $imageAnimal3;
	private $imageAnimal4;
	private $imageAnimal5;
	private $imageAnimal6;
	private $videoAnimal1;
	private $videoAnimal2;
	public $typeAnimal = 'GATO';

	/*
	* Método construtor
	* Define as operações á serem realizadas
	*/
	public function __construct($emailAnimal, $statusAnimal, $nameAnimal, $raceAnimal, $genderAnimal, $ageAnimal, $sizeAnimal, $weightAnimal, $deficientAnimal, $deficiencyAnimal, $vaccinatedAnimal, $castratedAnimal, $descriptionAnimal, $imageAnimal1, $imageAnimal2, $imageAnimal3, $imageAnimal4, $imageAnimal5, $imageAnimal6, $videoAnimal1, $videoAnimal2)
	{

		$CatId = OperationAnimal::getLastId();
		$idAnimal = $CatId[0] + 1;
		/*
		* Método construtor classe Pai
		*/
		parent::__construct($emailAnimal, $idAnimal, $this->typeAnimal, $statusAnimal);
		$this->nameAnimal = $nameAnimal;
		$this->raceAnimal = $raceAnimal;
		$this->genderAnimal = $genderAnimal;
		$this->ageAnimal = $ageAnimal;
		$this->sizeAnimal = $sizeAnimal;
		$this->weightAnimal = $weightAnimal;
		$this->deficientAnimal = $deficientAnimal;
		$this->deficiencyAnimal = $deficiencyAnimal;
		$this->vaccinatedAnimal = $vaccinatedAnimal;
		$this->castratedAnimal = $castratedAnimal;
		$this->descriptionAnimal = $descriptionAnimal;
		$this->imageAnimal1 = $imageAnimal1;
		$this->imageAnimal2 = $imageAnimal2;
		$this->imageAnimal3 = $imageAnimal3;
		$this->imageAnimal4 = $imageAnimal4;
		$this->imageAnimal5 = $imageAnimal5;
		$this->imageAnimal6 = $imageAnimal6;
		$this->videoAnimal1 = $videoAnimal1;
		$this->videoAnimal2 = $videoAnimal2;
	}
	/*
	* Método createAnimal
	* Responsável pela criação no banco de dados de um animal do tipo "GATO"
	*/
	public function createAnimal()
	{
		try
		{	
			// define o LOCALE do sistema, para permitir ponto decimal.
			setlocale(LC_NUMERIC, 'POSIX');

			// cria uma instrução de INSERT
			$sql = new SSqlInsert;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// atribui o valor de cada coluna
			$sql->setRowData('emailConta', $this->emailAnimal);
			$sql->setRowData('idAnimal', $this->idAnimal);
			$sql->setRowData('tipoAnimal', $this->typeAnimal);
			$sql->setRowData('statusAnimal', $this->statusAnimal);
			$sql->setRowData('dataCriacaoAnimal', $this->creationDateAnimal);
			$sql->setRowData('ultimaAtualizacaoAnimal', $this->updateDateAnimal);
			$sql->setRowData('ipOrigemCriacaoAnimal', $this->originIpCreationAnimal);
			
			// cria uma instrução de INSERT
			$sqlComplement = new SSqlInsert;

			// cria uma instrução de INSERT
			$sqlComplement->setEntity('dadosAnimaisGato');

			// atribui o valor de cada coluna
			$sqlComplement->setRowData('idAnimal', $this->idAnimal);
			$sqlComplement->setRowData('nomeAnimal', $this->nameAnimal);
			$sqlComplement->setRowData('racaAnimal', $this->raceAnimal);
			$sqlComplement->setRowData('sexoAnimal', $this->genderAnimal);
			$sqlComplement->setRowData('idadeAnimal', $this->ageAnimal);
			$sqlComplement->setRowData('porteAnimal', $this->sizeAnimal);
			$sqlComplement->setRowData('pesoAnimal', $this->weightAnimal);
			$sqlComplement->setRowData('deficienteAnimal', $this->deficientAnimal);
			$sqlComplement->setRowData('deficienciaAnimal', $this->deficiencyAnimal);
			$sqlComplement->setRowData('vacinadoAnimal', $this->vaccinatedAnimal);
			$sqlComplement->setRowData('castradoAnimal', $this->castratedAnimal);
			$sqlComplement->setRowData('descricaoAnimal', $this->descriptionAnimal);
			$sqlComplement->setRowData('imagemAnimal1', $this->imageAnimal1);
			$sqlComplement->setRowData('imagemAnimal2', $this->imageAnimal2);
			$sqlComplement->setRowData('imagemAnimal3', $this->imageAnimal3);
			$sqlComplement->setRowData('imagemAnimal4', $this->imageAnimal4);
			$sqlComplement->setRowData('imagemAnimal5', $this->imageAnimal5);
			$sqlComplement->setRowData('imagemAnimal6', $this->imageAnimal6);
			$sqlComplement->setRowData('videoAnimal1', $this->videoAnimal1);
			$sqlComplement->setRowData('videoAnimal2', $this->videoAnimal2);
			$sqlComplement->setRowData('urlPerfilAnimal', 'Gato, Gatos, Gata, Gatas, Gatinho, Gatinha, Gatinhos, Gatinhas');
		
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
			STransaction::log("Criando animal '". $this->idAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $sql->getInstruction());
			STransaction::log("Criando animal GATO '". $this->idAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $sqlComplement->getInstruction());
			STransaction::log("Criado animal GATO '". $this->idAnimal ."' ==> '" . $this->emailAnimal . "'");
		
			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch (Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro criar animal '". $this->idAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}

	/*
	* Método updateAnimal
	* Método responsável pela atualização de um animal do tipo GATO
	* @param emailSearch = Email á ser atualizado com as informações no método construtor
	*/
	public function updateAnimal($SearchidAnimal)
	{
		try
		{
			// cria critério de seleção de dados
			$criteria = new SCriteria;
			$criteria->add(new SFilter('idAnimal', '=', $SearchidAnimal));

			// cria uma instrução de UPDATE
			$sql = new SSqlUpdate;

			// define o nome da entidade
			$sql->setEntity('dadosAnimais');

			// atribui o valor de cada coluna
			$sql->setRowData('emailConta', $this->emailAnimal);
			$sql->setRowData('statusAnimal', $this->statusAnimal);
			$sql->setRowData('ultimaAtualizacaoAnimal', $this->updateDateAnimal);

			// define o critério de seleção de dados
			$sql->setCriteria($criteria);

			// cria critério de seleção de dados
			$criteria1 = new SCriteria;
			$criteria1->add(new SFilter('idAnimal', '=', $SearchidAnimal));
			
			// cria uma instrução de UPDATE
			$sqlComplement = new SSqlUpdate;

			// cria uma instrução de UPDATE
			$sqlComplement->setEntity('dadosAnimaisGato');

			// atribui o valor de cada coluna
			$sqlComplement->setRowData('nomeAnimal', $this->nameAnimal);
			$sqlComplement->setRowData('racaAnimal', $this->raceAnimal);
			$sqlComplement->setRowData('sexoAnimal', $this->genderAnimal);
			$sqlComplement->setRowData('idadeAnimal', $this->ageAnimal);
			$sqlComplement->setRowData('porteAnimal', $this->sizeAnimal);
			$sqlComplement->setRowData('pesoAnimal', $this->weightAnimal);
			$sqlComplement->setRowData('deficienteAnimal', $this->deficientAnimal);
			$sqlComplement->setRowData('deficienciaAnimal', $this->deficiencyAnimal);
			$sqlComplement->setRowData('vacinadoAnimal', $this->vaccinatedAnimal);
			$sqlComplement->setRowData('castradoAnimal', $this->castratedAnimal);
			$sqlComplement->setRowData('descricaoAnimal', $this->descriptionAnimal);
			$sqlComplement->setRowData('imagemAnimal1', $this->imageAnimal1);
			$sqlComplement->setRowData('imagemAnimal2', $this->imageAnimal2);
			$sqlComplement->setRowData('imagemAnimal3', $this->imageAnimal3);
			$sqlComplement->setRowData('imagemAnimal4', $this->imageAnimal4);
			$sqlComplement->setRowData('imagemAnimal5', $this->imageAnimal5);
			$sqlComplement->setRowData('imagemAnimal6', $this->imageAnimal6);
			$sqlComplement->setRowData('videoAnimal1', $this->videoAnimal1);
			$sqlComplement->setRowData('videoAnimal2', $this->videoAnimal2);
			$sqlComplement->setRowData('urlPerfilAnimal', 'Gato, Gatos, Gata, Gatas, Gatinho, Gatinha, Gatinhos, Gatinhas');

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
			STransaction::log("Atualizando animal '". $SearchidAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $sql->getInstruction());
			STransaction::log("Atualizando animal GATO '". $SearchidAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $sqlComplement->getInstruction());
			STransaction::log("Atualizando animal GATO '". $SearchidAnimal ."' ==> '" . $this->emailAnimal . "'");
		
			// fecha a transação, aplicando todas as operações
			STransaction::close();
			
			return true;
		}
		catch (Exception $e)
		{
			// define a estratégia de LOG
			STransaction::setLogger(new SLoggerTXT('ERROR'));

			// escreve a mensagem de LOG
			STransaction::log("Erro atualizar animal '". $SearchidAnimal ."' ==> '" . $this->emailAnimal . "' ======> " . $e->getMessage());

			// desfaz as operações realizadas durante a transação
			STransaction::rollback();

			// fecha a transação, aplicando todas as operações
			STransaction::close();

			return false;
		}
	}
}
?>
