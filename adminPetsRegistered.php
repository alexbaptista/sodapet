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
							
						case 'ONG':

						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />
						<div class=\"navbar\">
						<div class=\"navbar-inner\">
						<a class=\"brand\" href=\"adminAccount.php\">Home</a>
						<a class=\"brand\" href=\"adminPets.php\">Meus Pets</a>
						<ul class=\"nav\">
						<li class=\"active\"><a href=\"adminPetsRegistered.php\">Animais cadastrados</a></li>
						</ul>
						</div></div>";;
						
						if($_GET['info'] == 'newanimal'){

							echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Novo animal cadastrado</div>";

						}
						else if($_GET['info'] == 'updatedanimal'){

							echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Animal atualizado</div>";

						}
						else if($_GET['delete']){

							echo "<div class=\"alert alert-block\">
								  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								  <strong><button type=\"button\" class=\"btn btn-warning\" Onclick=\"location.href='sodapet.control/processDeleteAnimal.class.php?id=".$_GET['delete']."'\">Clique aqui</button> para confirmar a exclusão do animal #".$_GET['delete']."</strong>
								</div>";
						}
						else if($_GET['statusdelete'] == 200){

							echo "<div class=\"alert alert-success\">
								  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								  <strong>Animal excluído com sucesso !</strong>
								</div>";
						}
						else if($_GET['statusdelete'] == 400){

							echo "<div class=\"alert alert-error\">
								  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								  <strong>Erro temporário para a exclusão do animal, por favor tente novamente</strong>
								</div>";
						}
						else if($_GET['statusaction'] == 500){

							echo "<div class=\"alert alert-error\">
								  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
								  <strong>Esta operação não é permitida com o seu perfil de conta</strong>
								</div>";
						}
			
						echo "<table class=\"table table-striped table-bordered\" style=\"background-color:white;\">";
						echo "<tr><td>ID Animal</td><td>Nome Animal</td><td>Raça</td><td>Sexo</td><td>Perfil</td><td>Editar</td><td>Excluir</td></tr>";
					
						$quantidadeAnimais = count(OperationAnimal::checkCountAnimals($_SESSION['info'][0]));
						$valoresIDs = OperationAnimal::checkCountAnimals($_SESSION['info'][0]);

						for($i = $quantidadeAnimais - 1; $i >= 0; $i--)
						{	
							$dadosAnimais = OperationAnimal::loadInfoAnimal($valoresIDs[$i][0]);
							
							if($_GET['delete'] == $valoresIDs[$i][0])
							{	
								
								echo "<tr class=\"warning\"><td>#".$dadosAnimais[0]."</td><td>".$dadosAnimais[1]."</td><td>".$dadosAnimais[2]."</td><td>".$dadosAnimais[3]."</td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$dadosAnimais[0]."\"><i class=\"icon-zoom-in\"></i></a></td><td><a class=\"btn btn-small\" href=\"adminPetsEdit.php?id=".$dadosAnimais[0]."\"><i class=\"icon-edit\"></i></a></td><td><a class=\"btn btn-small\" href=\"adminPetsRegistered.php?delete=".$dadosAnimais[0]."\"><i class=\"icon-remove\"></i></a></td></tr>";				
							
							}
							else
							{
								
								echo "<tr><td>#".$dadosAnimais[0]."</td><td>".$dadosAnimais[1]."</td><td>".$dadosAnimais[2]."</td><td>".$dadosAnimais[3]."</td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$dadosAnimais[0]."\"><i class=\"icon-zoom-in\"></i></a></td><td><a class=\"btn btn-small\" href=\"adminPetsEdit.php?id=".$dadosAnimais[0]."\"><i class=\"icon-edit\"></i></a></td><td><a class=\"btn btn-small\" href=\"adminPetsRegistered.php?delete=".$dadosAnimais[0]."\"><i class=\"icon-remove\"></i></a></td></tr>";				
														
							}
						}
	
						echo "</table>";
						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";
						
						break;

						default:
		
						header('Location: adminAccount.php');

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
