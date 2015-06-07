<?php
/* 
* Classe processCreateAnimal
* Classe responsável pelo recebimento das informações por POST para a criação dos animais
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

// Verifica se há sessão ativa no sistema
if(isset($_SESSION['tipo']))
{
	// Verifica se a sessão pertence á uma ONG
	if($_SESSION['tipo'] == 'ONG')
	{
		// Verifica a origem do animal
		$verificaOrigemAnimal = OperationAnimal::checkAnimalID($_SESSION['info'][0],$_POST['idanimal']);
		
		// Verifica se o animal pertence á Ong
		if($verificaOrigemAnimal)
		{
			// armazena o tipo de animal á ser cadastrado
			$type = $_POST['especie'];

			// Verifica qual o tipo de animal para o cadastro correto
			Switch($type)
			{
				// Criação de um animal (Cão)
				case 'CAO':
			
					// Resgate das variáveis
					$nome = $_POST['nome'];
					$raca = $_POST['raca'];
					$especie = $_POST['especie'];
					$Sexo = $_POST['Sexo'];
					$idade = substr($_POST['idade'],0,2);
					$peso = substr($_POST['peso'],0,2);
					$porte = $_POST['porte'];
					$deficiente = $_POST['deficiente'];
					$deficiencia = $_POST['deficiencia'];
					$vacinado = $_POST['vacinado'];
					$castrado = $_POST['castrado'];
					$descricao = $_POST['descricao'];
					$imagem1 = file_get_contents($_FILES['imagem1']['tmp_name']);
					$imagem2 = file_get_contents($_FILES['imagem2']['tmp_name']);
					$imagem3 = file_get_contents($_FILES['imagem3']['tmp_name']);
					$imagem4 = file_get_contents($_FILES['imagem4']['tmp_name']);
					$imagem5 = file_get_contents($_FILES['imagem5']['tmp_name']);
					$imagem6 = file_get_contents($_FILES['imagem6']['tmp_name']);
					$video1 = $_POST['video1'];
					$video2 = $_POST['video2'];
					$idAnimalEdit = $_POST['idanimal'];

					// Instancia as informações consultadas no BD sobre o animal para a comparação antes da atualização
					$infoAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimalEdit);

					// Verifica as condições da imagem do Upload
					if($_FILES['imagem1']['type'] != 'image/jpeg' && $_FILES['imagem1']['error'] == 0)
					{

						// Retorna para a página 'adminPetsNew.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img1formato");
					
					}
					else if($_FILES['imagem1']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img1tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem2']['type'] != 'image/jpeg' && $_FILES['imagem2']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img2formato");
					
					}
					else if($_FILES['imagem2']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img2tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem3']['type'] != 'image/jpeg' && $_FILES['imagem3']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img3formato");
					
					}
					else if($_FILES['imagem3']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img3tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem4']['type'] != 'image/jpeg' && $_FILES['imagem4']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img4formato");
					
					}
					else if($_FILES['imagem4']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img4tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem5']['type'] != 'image/jpeg' && $_FILES['imagem5']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img5formato");
					
					}
					else if($_FILES['imagem5']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img5tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem6']['type'] != 'image/jpeg' && $_FILES['imagem6']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img6formato");
					
					}
					else if($_FILES['imagem6']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img6tamanho");
								
					}
					else
					{
						
						if($_FILES['imagem1']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem1 = $infoAnimal[12];
																		
						}
						
						if($_FILES['imagem2']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem2 = $infoAnimal[13];
																														
						}
						
						if($_FILES['imagem3']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem3 = $infoAnimal[14];	
																	
						}
						
						if($_FILES['imagem4']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem4 = $infoAnimal[15];	
																		
						}
						
						if($_FILES['imagem5']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem5 = $infoAnimal[16];	
													
						}
						
						if($_FILES['imagem6']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem6 = $infoAnimal[17];	
																												
						}

						// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a atualização do animal
						$novoCao = new DogAnimal($_SESSION['info'][0],'DISPONIVEL', $nome, $raca, $Sexo, $idade, $porte, $peso, $deficiente, $deficiencia, $vacinado, $castrado, $descricao, $imagem1, $imagem2, $imagem3, $imagem4, $imagem5, $imagem6, $video1, $video2);

						// Efetua a tentativa de atualização do animal
						if($novoCao->updateAnimal($idAnimalEdit))
						{
							// Redireciona o usuário para a página de 'sucesso'
							header("Location: ../adminPetsRegistered.php?info=updatedanimal");
						}
						else
						{
							// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o erro com o BD
							header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=bd");
						}														
						
					}

				break;

				case 'GATO':
			
					// Resgate das variáveis
					$nome = $_POST['nome'];
					$raca = $_POST['raca'];
					$especie = $_POST['especie'];
					$Sexo = $_POST['Sexo'];
					$idade = substr($_POST['idade'],0,2);
					$peso = substr($_POST['peso'],0,2);
					$porte = $_POST['porte'];
					$deficiente = $_POST['deficiente'];
					$deficiencia = $_POST['deficiencia'];
					$vacinado = $_POST['vacinado'];
					$castrado = $_POST['castrado'];
					$descricao = $_POST['descricao'];
					$imagem1 = file_get_contents($_FILES['imagem1']['tmp_name']);
					$imagem2 = file_get_contents($_FILES['imagem2']['tmp_name']);
					$imagem3 = file_get_contents($_FILES['imagem3']['tmp_name']);
					$imagem4 = file_get_contents($_FILES['imagem4']['tmp_name']);
					$imagem5 = file_get_contents($_FILES['imagem5']['tmp_name']);
					$imagem6 = file_get_contents($_FILES['imagem6']['tmp_name']);
					$video1 = $_POST['video1'];
					$video2 = $_POST['video2'];
					$idAnimalEdit = $_POST['idanimal'];

					// Instancia as informações consultadas no BD sobre o animal para a comparação antes da atualização
					$infoAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimalEdit);

					// Verifica as condições da imagem do Upload
					if($_FILES['imagem1']['type'] != 'image/jpeg' && $_FILES['imagem1']['error'] == 0)
					{

						// Retorna para a página 'adminPetsNew.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img1formato");
					
					}
					else if($_FILES['imagem1']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img1tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem2']['type'] != 'image/jpeg' && $_FILES['imagem2']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img2formato");
					
					}
					else if($_FILES['imagem2']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img2tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem3']['type'] != 'image/jpeg' && $_FILES['imagem3']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img3formato");
					
					}
					else if($_FILES['imagem3']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img3tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem4']['type'] != 'image/jpeg' && $_FILES['imagem4']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img4formato");
					
					}
					else if($_FILES['imagem4']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img4tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem5']['type'] != 'image/jpeg' && $_FILES['imagem5']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img5formato");
					
					}
					else if($_FILES['imagem5']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img5tamanho");
								
					}
					// Verifica as condições da imagem do Upload
					else if($_FILES['imagem6']['type'] != 'image/jpeg' && $_FILES['imagem6']['error'] == 0)
					{

						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img6formato");
					
					}
					else if($_FILES['imagem6']['error'] == 1)
					{
						
						// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o tipo do arquivo existente
						header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=img6tamanho");
								
					}
					else
					{
						
						if($_FILES['imagem1']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem1 = $infoAnimal[12];
																		
						}
						
						if($_FILES['imagem2']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem2 = $infoAnimal[13];
																														
						}
						
						if($_FILES['imagem3']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem3 = $infoAnimal[14];	
																	
						}
						
						if($_FILES['imagem4']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem4 = $infoAnimal[15];	
																		
						}
						
						if($_FILES['imagem5']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem5 = $infoAnimal[16];	
													
						}
						
						if($_FILES['imagem6']['tmp_name'] == '')
						{
							
							// Associação para a gravação da mesma imagem
							$imagem6 = $infoAnimal[17];	
																				
						}

						// Caso não haja erros, as informações postadas no formulário são instanciadas no objeto para a atualização do animal
						$novoGato = new CatAnimal($_SESSION['info'][0],'DISPONIVEL', $nome, $raca, $Sexo, $idade, $porte, $peso, $deficiente, $deficiencia, $vacinado, $castrado, $descricao, $imagem1, $imagem2, $imagem3, $imagem4, $imagem5, $imagem6, $video1, $video2);

						// Efetua a tentativa de atualização do animal
						if($novoGato->updateAnimal($idAnimalEdit))
						{
							// Redireciona o usuário para a página de 'sucesso'
							header("Location: ../adminPetsRegistered.php?info=updatedanimal");
						}
						else
						{
							// Retorna para a página 'adminPetsEdit.php' com as informações já preenchidas no formulário e com a mensagem de alerta para o erro com o BD
							header("Location: ../adminPetsEdit.php?id=".$idAnimalEdit."&erro=bd");
						}	
					}

				break;

				default:
		
					header('Location: ../adminPetsRegistered.php');

				break;
		
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
