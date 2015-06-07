<?php
/*
 * classe SLogger
 * Esta classe provê uma interface abstrata para definição de algoritmos de LOG
 */
abstract class SLogger
{
    protected $typeFileLog; // Tipo de log á ser gerado ERROR ou OPERATION
    protected $filename;  // local do arquivo do log
    
    /*
     * método __construct()
     * instancia um logger
     * @param $typeFileLog = tipo de log á ser gerado ERROR (Erro) ou OPERATION (Operação).
     * @param $localFileLog = Define qual o local de gravação do log.
     */
    public function __construct($typeFileLog)
    {
	switch($typeFileLog)
	{
		case 'ERROR':
		$localFileLog = '/var/www/sodapet/public_html/sodapet.model/sodapet.logs/error_log';
		break;
		case 'OPERATION':
		$localFileLog = '/var/www/sodapet/public_html/sodapet.model/sodapet.logs/operation_log';
		break;
	}
	$this->typeFileLog = $typeFileLog;
        $this->filename = $localFileLog;
    }
    
    // define o método write como obrigatório
    abstract function write($message);
}
?>
