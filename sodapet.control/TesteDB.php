<?php
header('Content-Type: text/html; charset=utf-8');
/*
 * função __autoload()
 * carrega uma classe quando ela é necessária, ou seja, quando ela é instancia pela primeira vez.
 */
function __autoload($classe)
{
    if (file_exists("../sodapet.model/{$classe}.class.php"))
    {
        include_once "../sodapet.model/{$classe}.class.php";
    }
    else if (file_exists("../sodapet.model/sodapet.ado/{$classe}.class.php"))
    {
        include_once "../sodapet.model/sodapet.ado/{$classe}.class.php";
    }
}

////////////////////////////////////////// TESTE COM INSERT ///////////////////////////////////////

$tipodaconta = 'ONG';

// define o LOCALE do sistema, para permitir ponto decimal.
setlocale(LC_NUMERIC, 'POSIX');

// cria um objeto para obter informações gerais
$Info = new GeneralInfo;

// cria uma instrução de INSERT
$sql = new SSqlInsert;

// define o nome da entidade
$sql->setEntity('dadosConta');

// atribui o valor de cada coluna
$sql->setRowData('emailConta', 'webmaster@sodapet.org');
$sql->setRowData('tipoConta', $tipodaconta);
$sql->setRowData('statusConta', 'OK');
$sql->setRowData('senhaConta', md5('lz0fwrlz0fwr'));
$sql->setRowData('dataCriacaoConta', $Info->getDataHora());
$sql->setRowData('ipOrigemCriacaoConta', $Info->getIpOrigem());

switch($tipodaconta)
{
	case 'ONG':
		$sqlComplement = new SSqlInsert;
		$sqlComplement->setEntity('dadosContaOng');
		$sqlComplement->setRowData('emailConta','webmaster@sodapet.org');
		$sqlComplement->setRowData('cnpj','12345678901234');
		$sqlComplement->setRowData('razaoSocial','SODAPET LTDA');
		$sqlComplement->setRowData('descricao','ONG destinada para ajuda de animais necessitados');
		$sqlComplement->setRowData('logotipo','');
		$sqlComplement->setRowData('especialidade','AMBOS');
		$sqlComplement->setRowData('endereco','Rua Álvaro Silva');
		$sqlComplement->setRowData('enderecoNumero','33');
		$sqlComplement->setRowData('enderecoComplemento','');
		$sqlComplement->setRowData('cep','02723020');
		$sqlComplement->setRowData('bairro','Vila Siqueira');
		$sqlComplement->setRowData('cidade','São Paulo');
		$sqlComplement->setRowData('estado','SP');
		$sqlComplement->setRowData('telefoneComercial','551193755080');
		$sqlComplement->setRowData('telefoneMovel','551199718085');
		$sqlComplement->setRowData('idFacebook','');
		$sqlComplement->setRowData('idTwitter','');
		$sqlComplement->setRowData('website','');
		break;

	case 'USUARIO':
		$sqlComplement = new SSqlInsert;
		$sqlComplement->setEntity('dadosContaUsuario');
		$sqlComplement->setRowData('emailConta','webmaster@sodapet.org');
		$sqlComplement->setRowData('cpf','12345678901');
		$sqlComplement->setRowData('nomeCompleto','ALEX BAPTISTA');
		$sqlComplement->setRowData('dataNascimento','1988-07-27');
		$sqlComplement->setRowData('sexo','M');
		$sqlComplement->setRowData('estadoCivil','SOLTEIRO');
		$sqlComplement->setRowData('Moradia','CASA');
		$sqlComplement->setRowData('preferenciaRaca','CAO');
		$sqlComplement->setRowData('jaAdotouAnimal','N');
		$sqlComplement->setRowData('endereco','Rua Álvaro Silva');
		$sqlComplement->setRowData('enderecoNumero','33');
		$sqlComplement->setRowData('enderecoComplemento','');
		$sqlComplement->setRowData('cep','02723020');
		$sqlComplement->setRowData('bairro','Vila Siqueira');
		$sqlComplement->setRowData('cidade','São Paulo');
		$sqlComplement->setRowData('estado','SP');
		$sqlComplement->setRowData('telefoneResidencial','551139368226');
		$sqlComplement->setRowData('telefoneMovel','551199718085');
		$sqlComplement->setRowData('idFacebook','');
		$sqlComplement->setRowData('idTwitter','');
		break;
}

// processa a instrução SQL
echo $sql->getInstruction();
echo "<br><br>";
echo $sqlComplement->getInstruction();
echo "<br><br>\n";

////////////////////////////////////////// TESTE COM UPDATE ///////////////////////////////////////


// cria critério de seleção de dados
$criteria = new SCriteria;
$criteria->add(new SFilter('emailConta', '=', 'webmaster@sodapet.org'));

// cria instrução de UPDATE
$sql1 = new SSqlUpdate;

// define a entidade
$sql1->setEntity('dadosContaOng');

// atribui o valor de cada coluna
$sql1->setRowData('cnpj', '12345678901235');
$sql1->setRowData('razaoSocial', 'SODAPET SA');
$sql1->setRowData('idFacebook', 'https://facebook.com');

// define o critério de seleção de dados
$sql1->setCriteria($criteria);

// processa a instrução SQL
echo $sql1->getInstruction();
echo "<br><br>\n";


////////////////////////////////////////// TESTE COM SELECT ///////////////////////////////////////


// cria critério de seleção de dados
$criteria1 = new SCriteria;
$criteria1->add(new SFilter('emailConta', '=', 'webmaster@sodapet.org'));
$criteria1->add(new SFilter('senhaConta', '=', md5('lz0fwrlz0fwr')));

// define o intervalo de consulta
//$criteria1->setProperty('offset', 0);
//$criteria1->setProperty('limit', 10);

// define o ordenamento da consulta
//$criteria1->setProperty('order', 'nome');

// cria instrução de SELECT
$sql2 = new SSqlSelect;

// define o nome da entidade
$sql2->setEntity('dadosConta');

// acrescenta colunas à consulta
$sql2->addColumn('tipoConta');
$sql2->addColumn('statusConta');

// define o critério de seleção de dados
$sql2->setCriteria($criteria1);

// processa a instrução SQL
echo $sql2->getInstruction();
echo "<br><br>\n";

////////////////////////////////////////// TESTE COM DELETE ///////////////////////////////////////

// cria critério de seleção de dados
$criteria2 = new SCriteria;
$criteria2->add(new SFilter('emailConta', '=', 'webmaster@sodapet.org'));

// cria instrução de DELETE
$sql3 = new SSqlDelete;

// define a entidade
$sql3->setEntity('dadosConta');

// define o critério de seleção de dados
$sql3->setCriteria($criteria2);

// processa a instrução SQL
echo $sql3->getInstruction();
echo "<br>\n";

////////////////////////////////////////// CONEXÃO COM O DB ///////////////////////////////////////

try
{
    // abre uma transação
    STransaction::open('mysql');

    // define a estratégia de LOG
    STransaction::setLogger(new SLoggerTXT('OPERATION'));
   
    // abre conexão com a base sodapet (mysql)
    $conn = STransaction::get();
    
    // executa a instrução SQL
    $insert = $conn->query($sql->getInstruction());
    $insertFK = $conn->query($sqlComplement->getInstruction());
    $update = $conn->query($sql1->getInstruction());
    $select = $conn->query($sql2->getInstruction());
    $delete = $conn->query($sql3->getInstruction());

    // escreve a mensagem de LOG
    STransaction::log($sql->getInstruction());
    STransaction::log($sqlComplement->getInstruction());
    STransaction::log($sql1->getInstruction());
    STransaction::log($sql2->getInstruction());
    STransaction::log($sql3->getInstruction());

    echo 'insert = ' . $insert->rowCount() . "<br>";
    echo 'insertFK = ' . $insertFK->rowCount() . "<br>";
    echo 'update = ' . $update->rowCount() . "<br>";
    echo 'select = ' . $select->rowCount() . "<br>";
    echo 'delete = ' . $delete->rowCount();

    // fecha a transação, aplicando todas as operações
    STransaction::close();
}
catch (Exception $e)
{
    // define a estratégia de LOG
    STransaction::setLogger(new SLoggerTXT('ERROR'));

    // escreve a mensagem de LOG
    STransaction::log($e->getMessage());

    // desfaz as operações realizadas durante a transação
    STransaction::rollback();

    // fecha a transação, aplicando todas as operações
    STransaction::close();
    die();
}
// Criação das classes de criação de conta, autenticação de conta, gerador de sessão, gerenciamento de funcionalidades (view).
?>
