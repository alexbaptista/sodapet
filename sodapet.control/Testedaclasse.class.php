<?php
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



$Conta = new OngAccount('webmaster@sodapet.org', 'lz0fwrlz0fwr', 'OK', 'Rua Álvaro Silva', '33', '', '02723020', 'Vila Siqueira', 'São Paulo', 'SP', '5511993755080', 'https://www.facebook.com/alexcbap', '', '12345678901234', 'Sodapet Organização não-governamental', 'Sodapet S.A', 'Ong destinada ao auxílio de animais', '', 'AMBOS', '551155214525', 'http://www.sodapet.org');


if($Conta->createAccount())
{
	echo 'criado conta Ong';
}
else
{
	echo 'não criado conta Ong';
}

echo "<br>";


if($Conta->updateAccount('webmaster@sodapet.org'))
{
	echo 'atualizado conta Ong';
}
else
{
	echo 'não atualizado conta Ong';
}

echo "<br>";


$Conta2 = new UserAccount('webmaster1@sodapet.org', 'lz0fwrlz0fwr', 'OK', 'Rua Álvaro Silva', '33', '', '02723020', 'Vila Siqueira', 'São Paulo', 'SP', '5511993755080', 'https://www.facebook.com/alexcbap', '', '00000000191', 'Alex Caio dos Santos Baptista', '1988-07-27', 'M','SOLTEIRO', 'CASA', 'CAO', 'N', '551139368226');



if($Conta2->createAccount())
{
	echo 'criado conta Usuario';
}
else
{
	echo 'não criado conta Usuario';
}


echo "<br>";


if($Conta2->updateAccount('webmaster1@sodapet.org'))
{
	echo 'atualizado conta Usuario';
}
else
{
	echo 'não atualizado conta Usuario';
}


echo "<br>";


$conta3 = OperationAccount::checkTypeAccount('webmaster@sodapet.org');


if($conta3)
{
	echo 'tipo de conta localizada<br>';
	print_r($conta3);
}
else
{
	echo 'tipo de conta não localizada';
}

echo "<br>";

$conta4 = OperationAccount::checkStatusAccount('webmaster@sodapet.org');


if($conta4)
{
	echo 'status de conta localizada<br>';
	print_r($conta4);
}
else
{
	echo 'status de conta não localizada';
}

$conta5 = OperationAccount::checkPasswordAccount('webmaster@sodapet.org');


if($conta5)
{
	echo 'senha de conta localizada<br>';
	print_r($conta5);
}
else
{
	echo 'senha de conta não localizada';
}

$conta6 = OperationAccount::setNewPasswordAccount('webmaster@sodapet.org','lz0fwrlz0fwr');

if($conta6)
{
	echo 'senha de conta alterada<br>';
	print_r($conta6);
}
else
{
	echo 'senha de conta não alterada';
}

$conta7 = OperationAccount::loadInfoAccount('webmaster@sodapet.org');

if($conta7)
{
	echo 'Dados de conta localizados<br>';
	print_r($conta7);
}
else
{
	echo 'Dados de conta não localizados';
}

$conta8 = OperationAccount::loadInfoAccountOng('webmaster@sodapet.org');

if($conta8)
{
	echo 'Dados de conta Ong localizados<br>';
	print_r($conta8);
}
else
{
	echo 'Dados de conta Ong não localizados';
}

$conta9 = OperationAccount::loadInfoAccountUser('webmaster1@sodapet.org');

if($conta9)
{
	echo 'Dados de conta Usuario localizados<br>';
	print_r($conta9);
}
else
{
	echo 'Dados de conta Usuario não localizados';
}

/*
$conta10 = OperationAccount::deleteAccount('webmaster@sodapet.org');

if($conta10)
{
	echo 'Dados de conta deletados<br>';
	print_r($conta10);
}
else
{
	echo 'Dados de conta não deletados';
}

$conta11 = OperationAccount::deleteAccount('webmaster1@sodapet.org');

if($conta11)
{
	echo 'Dados de conta deletados<br>';
	print_r($conta11);
}
else
{
	echo 'Dados de conta não deletados';
}

$conta12 = OperationAccount::lockAccount('webmaster@sodapet.org');

if($conta12)
{
	echo 'Conta bloqueada<br>';
	print_r($conta12);
}
else
{
	echo 'Conta não bloqueada';
}

$conta13 = OperationAccount::unlockAccount('webmaster@sodapet.org');

if($conta13)
{
	echo 'Conta desbloqueada<br>';
	print_r($conta13);
}
else
{
	echo 'Conta não desbloqueada';
}
*/

$Conta14 = new DogAnimal('webmaster@sodapet.org', 'DISPONIVEL', 'REX', 'PASTOR ALEMÃO', 'M', '2', 'G', '30Kg', 'S', 'Cego', 'S', 'S', 'Cãozinho amável', '', '', '', '', '', '', '', '');

if($Conta14->createAnimal())
{
	echo 'criado animal';
}
else
{
	echo 'não criado animal';
}
if($Conta14->updateAnimal('1'))
{
	echo 'atualizado animal';
}
else
{
	echo 'não atualizado animal';
}

echo "<br>";

$Conta14 = new CatAnimal('webmaster@sodapet.org', 'DISPONIVEL', 'LOLA', 'VIRA-LATA', 'F', '2', 'G', '30Kg', 'S', 'Cego', 'S', 'S', 'Gatinho Amável', '', '', '', '', '', '', '', '');

if($Conta14->createAnimal())
{
	echo 'criado animal';
}
else
{
	echo 'não criado animal';
}
if($Conta14->updateAnimal('1'))
{
	echo 'atualizado animal';
}
else
{
	echo 'não atualizado animal';
}

echo "<br>";

$conta15 = new Donation();

if($conta15->createTicket('1','webmaster@sodapet.org','webmaster1@sodapet.org','Gatinho lindo'))
{
	echo "Criado Ticket";
}
else
{
	echo "Não criado Ticket";
}

echo "<br>";

$conta16 = new Donation();

if($conta16->updateTicketOng('1','ANALISE','Beleza o animal é seu !'))
{
	echo "Atualizado Ticket ONG";
}
else
{
	echo "Não atualizado Ticket ONG";
}

echo "<br>";

$conta17 = new Donation();

if($conta17->updateTicketUser('1','CANCELADO','Eu não quero adotar'))
{
	echo "Atualizado Ticket USER";
}
else
{
	echo "Não atualizado Ticket USER";
}

echo "<br>";

$conta18 = new Abuse();

if($conta18->createTicket('alexcaio5@gmail.com','ONG','Esta ONG não existe'))
{
	echo "Criado Ticket ABUSE";
}
else
{
	echo "Não criado Ticket ABUSE";
}

echo "<br>";

if($conta18->updateTicket('1','CONCLUIDO','A ONG está bloqueada, agradecemos o contato'))
{
	echo "Atualizado Ticket ABUSE";
}
else
{
	echo "Não Atualizado Ticket ABUSE";
}

echo  "<br>";
$conta19 = OperationAccount::checkCnpj('12345678901234');

if($conta19)
{
	echo 'CNPJ existe<br>';
	print_r($conta19);
}
else
{
	echo 'CNPJ não existe';
}

echo  "<br>";
$conta20 = OperationAccount::checkCpf('00000000191');

if($conta20)
{
	echo 'CPF existe<br>';
	print_r($conta20);
}
else
{
	echo 'CPF não existe';
}

echo  "<br>";
$conta21 = OperationAnimal::checkCountAnimals('webmaster@sodapet.org');

if($conta21)
{
	echo 'Há animais<br>';
	print_r($conta21);
}
else
{
	echo 'Não tem animais';
}

echo  "<br>";
$conta22 = OperationAnimal::loadInfoAnimal(2);

if($conta22)
{
	echo 'Info<br>';
	print_r($conta22);
}
else
{
	echo 'Sem Info';
}

echo  "<br>";
$conta23 = OperationAnimal::loadInfoAnimalEdit(41);

if($conta23)
{
	echo 'Info<br>';
	print_r($conta23);
}
else
{
	echo 'Sem Info';
}

echo  "<br>";
$conta24 = OperationAnimal::checkAnimalID('webmaster21@sodapet.org',62);

if($conta24)
{
	echo 'pertence á ONG<br>';
	print_r($conta24);
}
else
{
	echo 'Não pertence á ONG';
}
?>
