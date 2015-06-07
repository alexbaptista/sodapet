<?php
/* 
* Classe processDeleteAnimal
* Classe responsável pelo processamento e exclusão de informações de animais
*/

// Início da sessão
session_start();

/*
* função __autoload
* Para carregar as classes necessárias da camada "model" para a execução das operações de forma tem.
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

//Resgata as informações passadas por GET
$idAnimal = $_GET['id'];

// Verifica se há sessão ativa no sistema
if(isset($_SESSION['tipo']))
{
	// Verifica se a sessão pertence á uma ONG
	if($_SESSION['tipo'] == 'ONG')
	{
		// Verifica se possui algum ID
		if(isset($idAnimal))
		{
			// Verifica a origem do animal
			$verificaOrigemAnimal = OperationAnimal::checkAnimalID($_SESSION['info'][0],$idAnimal);
			
			// Verifica se o animal pertence á Ong
			if($verificaOrigemAnimal)
			{
				// Instância o objeto para a exclusão do animal
				$exclusaoAnimal = OperationAnimal::deleteAnimal($idAnimal);
				
				//Verifica se foi excluído
				if($exclusaoAnimal)
				{
					
					header('Location: ../adminPetsRegistered.php?statusdelete=200');
				}
				else
				{
					
					header('Location: ../adminPetsRegistered.php?statusdelete=400');
				
				}
			}
			else
			{
				
				header('Location: ../adminPetsRegistered.php');				
				
			}
		}
		else
		{
			
			header('Location: ../adminPetsRegistered.php');
			
		}
	}
	else
	{

		header('Location: ../adminAccount.php');		
		
	}
}
else
{
	
	header('Location: ../');
	
}
?>
