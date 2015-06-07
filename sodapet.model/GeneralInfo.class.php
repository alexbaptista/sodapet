<?php
/*
* classe GeneralInfo
* Classe para a obtenção de informações como Data e Hora, Ip de Origem do visitante, browser e arquivo de configurações da aplicação
*/
final class GeneralInfo
{
	private $datahora; // Variável para armazenamento de data/hora
	private $ipOrigem; // Variável para armazenamento do IP de origem
	private $browser; // Variável para armazenamento do navegador de origem

	/* método construtor
	* alimenta as variáveis com as informações que serão requiridas nos métodos get
	*/
	function __construct(){
	       
		$this->datahora = new DateTime('now',new DateTimeZone('America/Sao_Paulo')); // Obtém a data/hora de origem do usuário
		$this->ipOrigem = $_SERVER['REMOTE_ADDR']; // Obtém o IP
		$this->browser = $_SERVER['HTTP_USER_AGENT']; // Obtém o browser requisitante
	}
	
	/*
	* Método getDatahora
	* Para obter informações sobre data e hora em tempo real
	* formato Ex: 2012-07-27-15:05:00
	*/
	public function getDatahora()
	{
		return $this->datahora->format('Y-m-d H:i:s');
	}

	/*
	* Método getDataLog
	* Para obter informações sobre data para o arquivo de log
	* formato Ex: 20120727
	*/
	public function getDataLog()
	{
		return $this->datahora->format('Ymd');
	}

	/*
	* Método getIpOrigem
	* Para obter informação sobre o IP de origem do requisitante
	* formato Ex: 127.0.0.1
	*/
	public function getIpOrigem()
	{
		return $this->ipOrigem;
	}
	/*
	* Método getBrowser
	* Para obter informação sobre o navegador do requisitante
	*/
	public function getBrowser()
	{
		return $this->browser;
	}
}
?>
