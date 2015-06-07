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
			
					// Resgata a identificação da Ong
					$idOng = $_GET['id'];
					
					// Instancia as informações consultadas no BD sobre o usuário
					$infoAccount = OperationAccount::loadInfoAccountOng($idOng);
					
					// Verifica a quantidade de animais para a Ong
					$qtdeAnimals = count(OperationAnimal::checkCountAnimals($infoAccount[0]));
					
					// Verifica a quantidade de Cães
					$qtdeAnimalsCao = count(OperationAnimal::checkCountAnimalsDog($infoAccount[0]));
					
					// Verifica a quantidade de Gatos
					$qtdeAnimalsGato = count(OperationAnimal::checkCountAnimalsCat($infoAccount[0]));			
					
					// Verifica a quantidade de doações no momento
					$qtdeDoacoes = count(OperationDonation::CountDonationOngDone($infoAccount[0]));
					
					if($infoAccount)
					{
					
						echo "<br /><div id=\"imagemAnimal\">
							<br />
							<img width=\"75%\" src=\"sodapet.control/showBrand.php?idlogo=".$infoAccount[1]."\" class=\"img-polaroid\" />
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
							</div>
						</div>
						<div id=\"dadosAnimal\" >
							<br />
							<div class=\"navbar\">
								<div class=\"navbar-inner\">
									<a class=\"brand\" href=\"#\"><h1>".$infoAccount[3]."</h1></a>
								</div>
							</div>
							<div class=\"bs-docs-example navbar-inner\">
								<ul id=\"myTab\" class=\"nav nav-tabs\" style=\"background-color:#D4D4D4;\">
									<li class=\"active\"><a href=\"#home\" data-toggle=\"tab\">Descrição</a></li>
									<li><a href=\"#profile\" data-toggle=\"tab\">Informações</a></li>
									<li><a href=\"#profile1\" data-toggle=\"tab\">Estatísticas</a></li>
									<li><a href=\"#profile2\" data-toggle=\"tab\">Cães</a></li>
									<li><a href=\"#profile3\" data-toggle=\"tab\">Gatos</a></li>
								</ul>
								<div id=\"myTabContent\" class=\"tab-content\" >
									<div class=\"tab-pane fade in active\" id=\"home\">
										<p>".$infoAccount[4]."</p>
									</div>
									<div class=\"tab-pane fade\" id=\"profile\">
										<p>Razão Social: <b>".$infoAccount[2]."</b></p>
										<p>CNPJ: <b>".substr($infoAccount[1],0,2).".".substr($infoAccount[1],2,3).".".substr($infoAccount[1],5,3)."/".substr($infoAccount[1],8,4)."-".substr($infoAccount[1],12,2)."</b> </p>
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
									<div class=\"tab-pane fade\" id=\"profile1\">
										<p>Quantidade de animais: <b>".$qtdeAnimals."</b></p>
										<p>Caes disponíveis: <b>".$qtdeAnimalsCao."</b></p>
										<p>Gatos disponíveis: <b>".$qtdeAnimalsGato."</b></p>
										<p>Total de doações efetivadas: <b>".$qtdeDoacoes."</b></p>				
									</div>
									<div class=\"tab-pane fade\" id=\"profile2\">";

									echo "<table class=\"table table-striped navbar-inner\" style=\"background-color:white;\">";
									echo "Últimos animais cadastrados...";
									echo "<br /><br />";
									echo "<tr><td>Nome Animal</td><td>Raça</td><td>Sexo</td><td>Ver perfil</td></tr>";

									// Busca os Ids dos Cães
									$ValoresIdsCaes = OperationAnimal::checkCountAnimalsDog($infoAccount[0]);
									
									
									for($i = $qtdeAnimalsCao - 1; $i >= 0; $i--)
									{	
										
										$dadosAnimais = OperationAnimal::loadInfoAnimal($ValoresIdsCaes[$i][0]);
										
										echo "<tr><td>".$dadosAnimais[1]."</td><td>".$dadosAnimais[2]."</td><td>".$dadosAnimais[3]."</td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$dadosAnimais[0]."\"><i class=\"icon-zoom-in\"></i></a></td></tr>";				
																	
									}
									
									echo "</table>";
						
									echo "</div>
									<div class=\"tab-pane fade\" id=\"profile3\">";
									echo "<table class=\"table table-striped navbar-inner\" style=\"background-color:white;\">";
									echo "Últimos animais cadastrados...";
									echo "<br /><br />";
									echo "<tr><td>Nome Animal</td><td>Raça</td><td>Sexo</td><td>Ver perfil</td></tr>";

									// Busca os Ids dos Gatos
									$ValoresIdsGatos = OperationAnimal::checkCountAnimalsCat($infoAccount[0]);
									
									for($i = $qtdeAnimalsGato - 1; $i >= 0; $i--)
									{	
										
										$dadosAnimais = OperationAnimal::loadInfoAnimal($ValoresIdsGatos[$i][0]);
										
										echo "<tr><td>".$dadosAnimais[1]."</td><td>".$dadosAnimais[2]."</td><td>".$dadosAnimais[3]."</td><td><a class=\"btn btn-small\" target=\"_blank\" href=\"animalProfile.php?id=".$dadosAnimais[0]."\"><i class=\"icon-zoom-in\"></i></a></td></tr>";				
																	
									}
									
									echo "</table>						
									</div>
								</div>
							</div>

						</div></div></div>";

						echo "<div class=\"row-fluid\"><div class=\"span12\"><br /><br /><br /><br />";
						echo "<div style=\"float:right;\" class=\"fb-comments\" data-href=\"http://www.sodapet.org/ongProfile.php?id=".$idOng."\" data-width=\"600\" data-num-posts=\"10\"></div>";
						echo "</div></div>";
						
					}
					else
					{
												
							header('Location: 404.php');
	
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
