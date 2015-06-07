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
			<div class="content">
			<?php
				if(isset($_SESSION['tipo']))
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
					
					switch($_SESSION['tipo'])
					{
						case 'USUARIO':
																
						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />";

						if($_GET['info'] == '200'){

							echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Solicitação registrada com êxito</div>";

						}
											
						echo "<div class=\"navbar\">
						  <div class=\"navbar-inner\">
						    <a class=\"brand\" href=\"adminAccount.php\">Home</a>
						    <ul class=\"nav\">
						      <li class=\"active\"><a href=\"adminDonations.php\">Minhas adoções</a></li>
						    </ul>
						  </div>
						</div>";

						echo "<table class=\"table table-striped table-bordered\" style=\"background-color:white;\">";
						echo "<tr><td>Ticket ID</td><td>Nome Animal</td><td>Nome Ong</td><td>Status</td><td>Ver animal</td></tr>";					
						
						$valoresTickets = OperationDonation::CountDonationUser($_SESSION['info'][0]);
						$quantidadeTickets = count($valoresTickets);
						
						for($i = $quantidadeTickets -1; $i >= 0; $i--)
						{
							// Busca informações da Ong (Nome)
							$infoAccount = OperationAccount::loadInfoAccountOng($valoresTickets[$i][2]);
							
							// Busca informações do animal (nome)
							$dadosAnimais = OperationAnimal::loadInfoAnimal($valoresTickets[$i][1]);
							
							if($valoresTickets[$i][4] == 'PENDENTE' || $valoresTickets[$i][4] == 'ANALISE')
							{
							
								echo "<tr><td>#".$valoresTickets[$i][0]."</td><td>".$dadosAnimais[1]."</td><td>".$infoAccount[2]."</td><td><button class=\"btn btn-warning\">Análise</button></td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$valoresTickets[$i][1]."\"><i class=\"icon-edit\"></i></a></td></tr>";	
							
							}
							else if($valoresTickets[$i][4] == 'APROVADO' || $valoresTickets[$i][4] == 'CANCELADO')
							{
									
								echo "<tr><td>#".$valoresTickets[$i][0]."</td><td>".$dadosAnimais[1]."</td><td>".$infoAccount[2]."</td><td><button class=\"btn btn-success\">Concluído</button></td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$valoresTickets[$i][1]."\"><i class=\"icon-edit\"></i></a></td></tr>";	
								
							}
						}					
						
						echo "</table>";
						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";					

						break;
				
						case 'ONG':

						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />";
						
						echo "<div class=\"navbar\">
						  <div class=\"navbar-inner\">
						    <a class=\"brand\" href=\"adminAccount.php\">Home</a>
						    <ul class=\"nav\">
						      <li class=\"active\"><a href=\"adminDonations.php\">Minhas doações</a></li>
						    </ul>
						  </div>
						</div>";

						echo "<table class=\"table table-striped table-bordered\" style=\"background-color:white;\">";
						echo "<tr><td>Ticket ID</td><td>Nome Animal</td><td>Nome Usuario</td><td>Status</td><td>Ver animal</td><td>Editar</td></tr>";
						
						$valoresTickets = OperationDonation::CountDonationOng($_SESSION['info'][0]);
						$quantidadeTickets = count($valoresTickets);
						
						for($i = $quantidadeTickets -1; $i >= 0; $i--)
						{
							// Busca informações da Ong (Nome)
							$infoAccount = OperationAccount::loadInfoAccountUser($valoresTickets[$i][3]);
							
							// Busca informações do animal (nome)
							$dadosAnimais = OperationAnimal::loadInfoAnimal($valoresTickets[$i][1]);
							
							if($valoresTickets[$i][4] == 'PENDENTE' || $valoresTickets[$i][4] == 'ANALISE')
							{
							
								echo "<tr><td>#".$valoresTickets[$i][0]."</td><td>".$dadosAnimais[1]."</td><td>".$infoAccount[2]."</td><td><button class=\"btn btn-warning\">Análise</button></td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$valoresTickets[$i][1]."\"><i class=\"icon-edit\"></i></a></td><td><a class=\"btn btn-small\" href=\"donationEdit.php?ticket=".$valoresTickets[$i][0]."\"><i class=\"icon-edit\"></i></a></td></tr>";	
							
							}
							else if($valoresTickets[$i][4] == 'APROVADO' || $valoresTickets[$i][4] == 'CANCELADO')
							{
									
								echo "<tr><td>#".$valoresTickets[$i][0]."</td><td>".$dadosAnimais[1]."</td><td>".$infoAccount[2]."</td><td><button class=\"btn btn-success\">Concluído</button></td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$valoresTickets[$i][1]."\"><i class=\"icon-edit\"></i></a></td><td><a class=\"btn btn-small\" href=\"donationEdit.php?ticket=".$valoresTickets[$i][0]."\"><i class=\"icon-edit\"></i></a></td></tr>";	
								
							}
						}
																						
						echo "</table>";
						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";					
				
						break;

						default:
		
						include 'sodapet.elements/restrict.php';
		
						break;
					}
				}
				else
				{
					include 'sodapet.elements/restrict.php';
				}
			?>
			</div>
			<div class="footer_shawdow"></div>
			<div class="footer">
				<?php include 'sodapet.elements/footer.php'?>
			</div>
		</div>
	</body>
</html>
