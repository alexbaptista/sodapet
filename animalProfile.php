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
		<script type="text/javascript" src="sodapet.widgets/jackwanders-GalleryView-cfeeb10/js/jquery.timers-1.2.js"></script>
		<script type="text/javascript" src="sodapet.widgets/jackwanders-GalleryView-cfeeb10/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="sodapet.widgets/jackwanders-GalleryView-cfeeb10/js/jquery.galleryview-3.0-dev.js"></script>
		<link type="text/css" rel="stylesheet" href="sodapet.widgets/jackwanders-GalleryView-cfeeb10/css/jquery.galleryview-3.0-dev.css" />
		<script type="text/javascript">
			$(function(){
				var tam = $(window).width()
				$('#myGallery').galleryView({
					panel_width: tam - (tam * 0.65),
					panel_height: (tam - (tam * 0.65))/2
				});
			});
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
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
			<div class="span12">
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
								
			// Resgata a identificação do animal
			$idAnimal = $_GET['id'];
			
			// Verifica a existência do animal pelo ID
			$infoAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimal);

			// Verifica á quem pertence o animal
			$infoOng = OperationAnimal::infoOngAnimal($idAnimal);

			// Instancia as informações consultadas no BD sobre o usuário
			$infoAccount = OperationAccount::loadInfoAccountOng($infoOng[0][0]);			
			
			// Verifica se encontrou o animal
			if($infoAnimal)
			{
				
				echo "<br />";
				
				if($_GET['status'] == 1)
				{
					
					echo "<div class=\"alert alert-warning\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Aviso ! - </strong>É necessário a autenticação para a conclusão desta ação</div>";
						
				}
				else if($_GET['status'] == 2)
				{
					
					echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Este animal não está mais disponível para adoção</div>";
						
				}
				else if($_GET['status'] == 3)
				{
					
					echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Já existe uma solicitação em andamento para a adoção deste animal</div>";
						
				}
				
				echo "<br /><div id=\"imagemAnimal\">
				<img width=\"75%\" src=\"sodapet.control/showImages1.php?animal=".$idAnimal."\" class=\"img-polaroid\" />
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
				<div class=\"btn-group\"><br />";
				
				if($infoOng[0][3] == 'DISPONIVEL')
				{
				
					echo "<button class=\"btn btn-danger\">
				<a href=\"adoptionRegister.php?idanimal=".$idAnimal."\"><h1 style=\"font-family:'museo_700regular';\">Adotar</h1></a>
				</button>";
				
				}
				else
				{
					echo "<button class=\"btn btn-success\">
				<a href=\"adoptionRegister.php?idanimal=".$idAnimal."\"><h1 style=\"font-family:'museo_700regular';\">Adotado</h1></a>
				</button>";				
					
				}
				
				echo "</div>
				</div>
			</div>
				<div id=\"dadosAnimal\" >
					<div class=\"navbar\">
					  <div class=\"navbar-inner\">
					    <a class=\"brand\" href=\"#\"><h1>".$infoAnimal[1]."</h1></a>
					  </div>
					</div>
					<div class=\"bs-docs-example navbar-inner\">
					    <ul id=\"myTab\" class=\"nav nav-tabs\" style=\"background-color:#D4D4D4;\">
					      <li class=\"active\"><a href=\"#home\" data-toggle=\"tab\">Dados</a></li>
					      <li><a href=\"#profile1\" data-toggle=\"tab\">Descrição</a></li>
						<li><a href=\"#profile2\" data-toggle=\"tab\">Imagens</a></li>
						<li><a href=\"#profile3\" data-toggle=\"tab\">Vídeos</a></li>
						<li><a href=\"#profile4\" data-toggle=\"tab\">Ong</a></li>
					    </ul>
					    <div id=\"myTabContent\" class=\"tab-content\" >
					      <div class=\"tab-pane fade in active\" id=\"home\">";
						
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
						

					    echo "</div>
					      <div class=\"tab-pane fade\" id=\"profile1\">
						<p>".$infoAnimal[11]."</p>
					      </div>
					      <div class=\"tab-pane fade\" id=\"profile2\">
								<center>
								<ul id=\"myGallery\">
									<li><img src=\"sodapet.control/showImages2.php?animal=".$idAnimal."\" alt=\"\" /></li>
									<li><img src=\"sodapet.control/showImages3.php?animal=".$idAnimal."\" alt=\"\" /></li>
									<li><img src=\"sodapet.control/showImages4.php?animal=".$idAnimal."\" alt=\"\" /></li>
									<li><img src=\"sodapet.control/showImages5.php?animal=".$idAnimal."\" alt=\"\" /></li>
									<li><img src=\"sodapet.control/showImages6.php?animal=".$idAnimal."\" alt=\"\" /></li>
								</ul>
								</center>
								<br />
					      </div>
					      <div class=\"tab-pane fade\" id=\"profile3\" height=\"100%\">
						<iframe width=\"100%\" height=\"50%\" src=\"http://www.youtube.com/embed/".$infoAnimal[18]."\" frameborder=\"0\"></iframe>
						<iframe width=\"100%\" height=\"50%\" src=\"http://www.youtube.com/embed/".$infoAnimal[19]."\" frameborder=\"0\"></iframe>	
					      </div>
					       <div class=\"tab-pane fade\" id=\"profile4\" height=\"100%\">
								<p>Ong: <b><h3><a target=\"_blank\" style=\"color:black;\" href=\"ongProfile.php?id=".$infoOng[0][0]."\">".$infoAccount[3]."</a></h3></b></p>
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
								<p>WebSite: <b>".$infoAccount[18]."</b></p>
					      </div>
					    </div>
					  </div><br /><br /></div></div></div>";
				
				echo "<div class=\"row-fluid\"><div class=\"span12\">";
				echo "<div style=\"float:right;\" class=\"fb-comments\" data-href=\"http://www.sodapet.org/animalProfile.php?id=".$idAnimal."\" data-width=\"600\" data-num-posts=\"10\"></div>";
			}
			else
			{
							
			header('Location: 404.php');		
			
			}	
			?>
			</div>
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
