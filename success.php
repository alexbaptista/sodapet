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
					$success = $_GET['success'];

					if ($success == 'yes')
					{
						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />";

						echo "<br /><br /><br /><br /><h2 align=\"center\">Parabéns a sua conta foi criada !</h2><h3 align=\"center\">Faça o logon na box acima</h3><br /><br /><p align=\"center\"><button class=\"btn btn-large btn-success\" data-loading-text=\"Processando...\" type=\"submit\" Onclick=\"location.href='index.php'\">Voltar</button></p>";

						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></div><div class=\"span1\"></div></div></div>";					

					}
					else
					{

						header('Location: index.php');

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
