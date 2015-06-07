<?php
/*
* Inclusão da classe GeneralInfo.class.php para a inclusão de data/hora e IP de origem no log de transação
*/
include_once '/var/www/sodapet/public_html/sodapet.model/GeneralInfo.class.php';

/*
 * classe SLoggerTXT
 * implementa o algoritmo de LOG
 */
class SLoggerTXT extends SLogger
{
    /*
     * método write()
     * escreve uma mensagem no arquivo de LOG
     * @param $message = mensagem a ser escrita
     */
    public function write($message)
    {
	// cria um objeto para obter informações gerais
	$Info = new GeneralInfo;
        
        // monta a string
        $text = "[" . $Info->getDatahora() . "] :: [" . $this->typeFileLog . "] :: [" . $Info->getIpOrigem() . "] :: [$message]\n[" . $Info->getBrowser() . "] \n\n";
        
        // adiciona ao final do arquivo
        $handler = fopen($this->filename . $Info->getDataLog() . ".log", 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
?>
