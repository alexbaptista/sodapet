<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="title" content="SóDáPet - Sistema online de divulgação para adoção Pet" />
		<meta name="url" content="www.sodapet.org" />
		<meta name="description" content="Sistema especializado para a divulgação de animais abrigados em entidades não-governamentais." />
		<meta name="keywords" content="ong, animal, abandono, cão, gato, cachorro" />
		<meta name="charset" content="UTF-8" />
		<?php include 'sodapet.elements/head.php' ?>
		<title>SóDáPet - Sistema online de divulgação para adoção Pet</title>
	</head> 
    <body>
		<div class="geral">
			<div class="header">
				<?php include 'sodapet.elements/header.php'?>
			</div>
			<div class="header_shawdow"></div>
			<div class="aside fleft">
				<?php include 'sodapet.elements/asideLeft.php'?>
			</div>
			<div class="aside fright">
				<?php include 'sodapet.elements/asideRight.php'?>
			</div>
			<div class="content" >
				<div class="container-fluid navbar-inner">
				<?php
				// recupera o ID do animal
				$idAnimal = $_GET['idanimal'];
				
				// Verifica se foi passado como argumento o ID do animal
				if($idAnimal != '')
				{
				
					if (isset($_SESSION['tipo']))
					{
						/*
						* função __autoload
						* Para carregar as classes necessárias da camada "model" para a execução das operações de forma tem.
						*/
						function __autoload($classe)
						{
							if (file_exists("sodapet.model/{$classe}.class.php"))
							{
								include_once "sodapet.model/{$classe}.class.php";
							}
							else if (file_exists("sodapet.model/sodapet.ado/{$classe}.class.php"))
							{
								include_once "sodapet.model/sodapet.ado/{$classe}.class.php";
							}
						}
						
						// Verifica a existência do animal pelo ID
						$infoAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimal);						

						switch($_SESSION['tipo'])
						{
							case 'USUARIO':
							
							if($infoAnimal)
							{
								// Verifica á quem pertence o animal
								$infoOng = OperationAnimal::infoOngAnimal($idAnimal);
								
								// Verifica o status do animal
								if($infoOng[0][3] == 'DISPONIVEL')
								{
								
									// Verifica a existência de doação em andamento para este usuário neste mesmo animal
									$infoTicketAnimal = OperationDonation::checkDonationUser($idAnimal, $_SESSION['info'][0]);
									
									// Checa se de fato existe um ticket para o usuário do mesmo animal
									if(!$infoTicketAnimal)
									{
										
										// Verifica á quem pertence o animal
										$infoOng = OperationAnimal::infoOngAnimal($idAnimal);

										// Instancia as informações consultadas no BD sobre o usuário
										$infoAccount = OperationAccount::loadInfoAccountOng($infoOng[0][0]);
										
										echo "<div class=\"span1\"></div><div class=\"span10\"><br/>";
										
										if($_GET['erro'] == 'bd')
										{
						
											echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

										}
										
										echo "<h2>Confirmação da solicitação de adoção</h2>";
										echo "<h4>Falta pouco para a conclusão desta ação, e ressaltando alguns pontos:</h4><br />";
										echo "<h5>- A análise da solicitação fica á encargo da Ong responsável pelo animal;</h5>";
										echo "<h5>- Denuncie qualquer prática/tentativa de comercialização do animal por meio do SóDáPet;</h5>";
										echo "<h5>- Lembre-se, este é um passo importante, em caso de dúvidas verifique com a Ong responsável;</h5><br />";								
										
										
										echo "<form id=\"confirmDonation\" name=\"confirmDonation\" method=\"post\" action=\"sodapet.control/processAdoptionRegister.class.php\">";

										echo "<legend>Confirme os dados da requisição</legend>";

										echo "<h3><p>Nome: <b>".$infoAnimal[1]."</b></p></h3>";
										
										if($infoAnimal[21] == 'CAO')
										{
										
											echo "<p>Espécie: <b>Cachorro</b></p>";
										
										}
										else
										{

											echo "<p>Espécie: <b>Gato</b></p>";							
											
										}
										
										if($infoAnimal[3] == 'M')
										{
											
											echo "<p>Sexo: <b>Macho</b></p>";							
											
										}
										else
										{
											
											echo "<p>Sexo: <b>Fêmea</b></p>";							
											
										}
										

										echo "<p>Raça: <b>".$infoAnimal[2]."</b></p>
										<p>Idade: <b>".$infoAnimal[4]." Ano(s)</b></p>";
										
										if($infoAnimal[5] == 'P')
										{
										
											echo "<p>Porte: <b>Pequeno</b></p>";
										
										}
										else if($infoAnimal[5] == 'M')
										{
											
											echo "<p>Porte: <b>Médio</b></p>";
											
										}
										else
										{
											
											echo "<p>Porte: <b>Grande</b></p>";
											
										}				
										
										echo "<p>Peso: <b>".$infoAnimal[6]." Kg</b></p>";
										
										if($infoAnimal[7] == 'S')
										{
										
											echo "<p>Deficiente: <b>Sim</b></p>";
											echo "<p>Qual ?: <b>".$infoAnimal[8]."</b></p>";
										
										}
										else
										{
											
											echo "<p>Deficiente: <b>Não</b></p>";
																	
										}
										
										if($infoAnimal[9] == 'S')
										{
											
											echo "<p>Vacinado ?: <b>Sim</b></p>";
										
										}
										else
										{

											echo "<p>Vacinado ?: <b>Não</b></p>";							
											
										}
										
										if($infoAnimal[10] == 'S')
										{
											
											echo "<p>Castrado ?: <b>Sim</b></p>";
																
										}
										else
										{
											
											echo "<p>Castrado ?: <b>Não</b></p>";
																		
										}
										echo "<p><h3>Ong: <a target=\"_blank\" style=\"color:black;\" href=\"ongProfile.php?id=".$infoOng[0][0]."\">".$infoAccount[3]."</a></h3></p>
										<p>Razão Social: <b>".$infoAccount[2]."</b></p>
										<p>CNPJ: <b>".substr($infoAccount[1],0,2).".".substr($infoAccount[1],2,3).".".substr($infoAccount[1],5,3)."/".substr($infoAccount[1],8,4)."-".substr($infoAccount[1],12,2)."</b></p>
										<p>Endereço: <b>".$infoAccount[7]."</b></p>
										<p>Número: <b>".$infoAccount[8]."</b></p>
										<p>Complemento: <b>".$infoAccount[9]."</b></p>
										<p>Bairro: <b>".$infoAccount[11]."</b></p>
										<p>Cidade: <b>".$infoAccount[12]."</b></p>
										<p>Estado: <b>".$infoAccount[13]."</b></p>
										<p>Telefone comercial: <b>(".substr($infoAccount[14],2,2).") ".substr($infoAccount[14],4,4)."-".substr($infoAccount[14],8,4)."</b></p>
										<p>Telefone Móvel: <b>(".substr($infoAccount[15],2,2).") ".substr($infoAccount[15],4,4)."-".substr($infoAccount[15],8,4)."</b></p>
										<p>Facebook: <b>".$infoAccount[16]."</b></p>
										<p>Twitter: <b>".$infoAccount[17]."</b></p>
										<p>WebSite: <b>".$infoAccount[18]."</b></p>";
																			
										echo "<legend>Informe abaixo um motivo desta adoção</legend>";
										
										echo "<div class=\"controls controls-row\">";
										echo "<label class=\"span5\">Para melhor análise da Ong</label>";
										echo "</div>";
										
										echo "<div class=\"controls controls-row\">";
										echo "<textarea rows=\"6\" class=\"span5\" id=\"descricao\" name=\"descricao\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\"></textarea>";
										echo "</div>";
										
										echo "<input type=\"hidden\" name=\"idanimal\" 	value=\"".$idAnimal."\" />";
										echo "<input type=\"hidden\" name=\"emailong\" 	value=\"".$infoOng[0][0]."\" />";
										echo "<input type=\"hidden\" name=\"emailuser\" value=\"".$_SESSION['info'][0]."\" />";										
										
										echo "<button class=\"btn btn-large btn-primary\"  type=\"submit\">Confirmar adoção</button>&nbsp;&nbsp;";
										echo "<button class=\"btn btn-large btn btn-danger\" Onclick='location.href=\"index.php\"' type=\"button\">Cancelar</button>";
										echo "</form>";
																
										echo "</div><div class=\"span1\"></div>";
									}
									else
									{
										
										header("Location: animalProfile.php?status=3&id=$idAnimal");
										
									}
									
								}
								else
								{
										
									header("Location: animalProfile.php?status=2&id=$idAnimal");							
									
								}
								
							}
							else
							{
								
								header('Location: 404.php');
							
							}

							break;
													
							case 'ONG':
							
							header('Location: adminPetsRegistered.php?statusaction=500');
							
							break;

							default:

							include 'sodapet.elements/restrict.php';

							break;					
						}
					}
					else
					{
						header("Location: animalProfile.php?status=1&id=$idAnimal");
					}
					
				}
				else
				{
					header('Location: index.php');
				}	
				
				?>
				</div>
		    </div>
			<div class="footer_shawdow"></div>
		    <div class="footer">
				<?php include 'sodapet.elements/footer.php'?>
		    </div>
		</div>
	</body>
</html>
