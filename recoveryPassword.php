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
				<div class="container-fluid navbar-inner">
				<div class="row-fluid">
				<div class="span2"></div>
				<div class="span8">
				<br /><br />
				<h1>Recuperar senha de acesso</h1>
					<form name="RecoveryPassword" method="get" action="#">
					<br /><br />
					<legend>Insira o seu Email</legend>
						<div class="controls controls-row">
							<input class="span5" type="text" name="email" placeholder="Email" style="font-family:'museo_500regular';" maxlength="50">
						</div>								
					<br />
					<button class="btn btn-large btn-primary" type="submit">Recuperar senha</button>&nbsp;&nbsp;
					<button type="button" class="btn btn-large btn btn-danger" onclick='location.href="index.php"'>Voltar</button>
					<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					</div>
					<div class="span2"></div>
					</div>
				</div>
			</div>
			<div class="footer_shawdow"></div>
			<div class="footer">
				<?php include 'sodapet.elements/footer.php'?>
			</div>
		</div>
	</body>
</html>
