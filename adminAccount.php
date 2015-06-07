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
					switch($_SESSION['tipo'])
					{
						case 'USUARIO':
							echo "<div class=\"container-fluid navbar-inner\">
							<div class=\"row-fluid\">
							<div class=\"span1\"></div>
							<div class=\"span10\">";
						
							echo "<br><div class=\"navbar\">
						  	<div class=\"navbar-inner\">
						    	<a class=\"brand\" href=\"adminAccount.php\">Bem vindo Sr(a) " . $_SESSION['info'][2] . "</a>
						  	</div>
							</div>";

							echo "<br><br><br><p align=\"center\">";
							echo "<button class=\"btn btn-large btn btn btn-danger\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='editAccount.php'\">Editar conta</button>";
							echo "&nbsp;&nbsp;";
							echo "<button class=\"btn btn-large btn btn btn-danger\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='adminDonations.php'\">Minhas adoções</button>";
							echo "</p><br />";				
							echo "<h4 align=\"center\">Qual a ação desejada ?</h4>";;

							echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";
							
						break;
				
						case 'ONG':

							echo "<div class=\"container-fluid navbar-inner\">
							<div class=\"row-fluid\">
							<div class=\"span1\"></div>
							<div class=\"span10\">";
							
							echo "<br><div class=\"navbar\">
						  	<div class=\"navbar-inner\">
						    	<a class=\"brand\" href=\"adminAccount.php\">Bem vindo Sr(a) " . $_SESSION['info'][3] . "</a>
						  	</div>
							</div>";

							echo "<br><br><br><p align=\"center\">";
							echo "<button class=\"btn btn-large btn btn btn-danger\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='editAccount.php'\">Editar conta</button>";
							echo "&nbsp;&nbsp;";
							echo "<button class=\"btn btn-large btn btn btn-danger\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='adminPets.php'\">Meus Pets</button>";
echo "&nbsp;&nbsp;";
							echo "<button class=\"btn btn-large btn btn btn-danger\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='adminDonations.php'\">Minhas doações</button>";
							echo "</p><br />";				
							echo "<h4 align=\"center\">Qual a ação desejada ?</h4>";

							echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";
										
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
