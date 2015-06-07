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
			<?php

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
								
			if($_GET['search'] == '')
			{
				header("Location: http://www.sodapet.org");
				exit;
			}
			
			$busca = $_GET['search'];
			//$busca = mysql_real_escape_string($busca);
			
			//$con = mysql_connect("186.202.152.27","sodapet2","lz0fwrlz0fwr");
			$con = mysql_connect("localhost","root","lz0fwrlz0fwr");
			
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}

			$result = mysql_query("SELECT idAnimal, nomeAnimal, racaAnimal FROM sodapet.dadosAnimaisCao WHERE dadosAnimaisCao.nomeAnimal LIKE '%".$busca."%' OR dadosAnimaisCao.racaAnimal LIKE '%".$busca."%' OR dadosAnimaisCao.descricaoAnimal LIKE '%".$busca."%' OR dadosAnimaisCao.urlPerfilAnimal LIKE '%".$busca."%' UNION ALL SELECT idAnimal, nomeAnimal, racaAnimal FROM sodapet.dadosAnimaisGato WHERE dadosAnimaisGato.nomeAnimal LIKE '%".$busca."%' OR dadosAnimaisGato.racaAnimal LIKE '%".$busca."%' OR dadosAnimaisGato.descricaoAnimal LIKE '%".$busca."%' OR dadosAnimaisGato.urlPerfilAnimal LIKE '%".$busca."%' ORDER BY idAnimal DESC");


			echo "<br />";
			echo "<div class=\"well well-small\">
			<h3 align=\"center\">Resultados encontrados para \"".$busca."\"</h3>
			</div>";	
			echo "<br />";
			
			
			while($row = mysql_fetch_array($result))
			{
				// Recupera informações de animais
				$dadosAnimais = OperationAnimal::infoOngAnimal($row['idAnimal']);
				
				echo "<div class=\"container-fluid\"><div class=\"row-fluid\"><div class=\"span12\">";
					
				echo "<div id=\"imagemAnimal\">
				<img width=\"75%\" src=\"sodapet.control/showImages1.php?animal=".$row['idAnimal']."\" class=\"img-polaroid\" />
				<div class=\"btn-group\">
			  	<button class=\"btn\">
				<a href=\"http://facebook.com\" target=\"_blank\"><img alt=\"FaceBook\" src=\"sodapet.images/glyphicons/png/glyphicons_390_facebook.png\" align=\"middle\"/></a>
				</button>
			  	<button class=\"btn\">
				<a href=\"http://plus.google.com\" target=\"_blank\"><img alt=\"Google Plus\" src=\"sodapet.images/glyphicons/png/glyphicons_386_google_plus.png\" align=\"middle\"/></a>
				</button>
			  	<button class=\"btn\">
			  	<a href=\"http://twitter.com\" target=\"_blank\"><img alt=\"Twitter\" src=\"sodapet.images/glyphicons/png/glyphicons_391_twitter_t.png\" align=\"middle\"/></a>
				</button>
				</div>";				
				
				
				echo "</div><div class=\"span7\">";
					
				echo "<div id=\"dadosAnimal2\"><div class=\"navbar\"><div class=\"navbar-inner\">
					<a class=\"brand\" target=\"_blank\" href=\"animalProfile.php?id=".$row['idAnimal']."\"><h4>Nome: ".utf8_encode($row['nomeAnimal'])."<br /><br />Raça: ".utf8_encode($row['racaAnimal'])."<br /><br />";
				
					if($dadosAnimais[0][2] == 'CAO')
					{
						echo "Espécie: Cão";
					}
					else
					{
						echo "Espécie: Gato";					
					}
				
				echo "</h4></a></div></div></div>";					
								
				echo "</div></div></div></div><br />";
			}
				
			echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";

			mysql_close($con);
			
			?>	
			</div>
			<div class="span1"></div>
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
