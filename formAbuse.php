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
				<div class="row-fluid">
				<div class="span1"></div>
				<div class="span10">
				<br /><br /><br /><br />
				<h2 align="center">Informar abuso de Usuário ou Ong</h2>
				<h4 align="center">Área destinada para a prevenção de fraudes que possam existir no SóDáPet</h4>
				<br /><br />
				<form name="createAbuse" method="post" action="#">

				<legend>Informe os seus dados pessoais</legend>

				<div class="controls">
				<input type="text" class="span5" name="email" placeholder="O seu endereço de Email" style="font-family:'museo_500regular';" maxlength="50">
				</div>
				<div class="controls controls-row">
				<label class="span5">Tipo de abuso á ser informado:</label>
				</div>
				<div class="controls controls-row">
				<select class="span5" name="tipo" style="font-family:'museo_500regular';">
				<option value="ONG">Ong</option>
				<option value="USUARIO">Usuário</option>
				</select>
				</div>
				<div class="controls controls-row">
				<label class="span5">Faça um descrição sobre a ocorrência</label>
				</div>
				<div class="controls controls-row">
				<textarea rows="6" class="span5" name="descricao" style="font-family:'museo_500regular';" maxlength="1024"></textarea>
				</div>
				<button class="btn btn-large btn-primary" data-loading-text="Processando..." data-dismiss="alert" type="submit">Informar abuso</button>&nbsp;&nbsp;
				<button class="btn btn-large btn btn-danger" data-loading-text="Processando..." Onclick='location.href="index.php"' type="button">Cancelar</button>
				</form>
		      	<br /><br /><br /><br />
				</div>
				<div class=\"span1\"></div>
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
