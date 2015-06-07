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
						<li class=\"active\"><a href=\"adminPetsNew.php\">Novo Animal</a></li>
						</ul>
						</div></div>";

						if($_GET['erro'] == 'img1formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 1 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img1tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 1 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'img2formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 2 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img2tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 2 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'img3formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 3 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img3tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 3 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'img4formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 4 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img4tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 4 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'img5formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 5 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img5tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 5 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'img6formato')
						{

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 6 - Está fora do formato específicado (JPEG)</div>";

						}
						else if($_GET['erro'] == 'img6tamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Imagem 6 - Está fora do tamanho específicado (2MB)</div>";

						}
						else if($_GET['erro'] == 'bd')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

						}

						echo "<form id=\"createAnimal\" name=\"createAnimal\" enctype=\"multipart/form-data\" method=\"post\" action=\"sodapet.control/processCreateAnimal.class.php\">

						<legend>Informe os dados do animal</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" id=\"nome\" value=\"".$_GET['nome']."\" name=\"nome\" placeholder=\"Nome\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span4\" id=\"raca\" value=\"".$_GET['raca']."\" name=\"raca\" placeholder=\"Raça\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span3\">Espécie</label>
						<label class=\"span2\">Sexo</label>
						</div>

						<div class=\"controls controls-row\">
						<select class=\"span3\" name=\"especie\" style=\"font-family:'museo_500regular';\">";
						
						if($_GET['especie'] == 'CAO')
						{				
							echo "<option selected=\"selected\" value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
						}
						else if($_GET['especie'] == 'GATO')
						{				
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option selected=\"selected\" value=\"GATO\">Gato</option>";
						}
						else
						{
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";													
						}
											
						echo "</select>
						<select class=\"span2\" name=\"Sexo\" style=\"font-family:'museo_500regular';\">";
						
						if($_GET['Sexo'] == 'M')
						{				
							echo "<option selected=\"selected\" value=\"M\">Macho</option>";
							echo "<option value=\"F\">Fêmea</option>";
						}
						else if($_GET['Sexo'] == 'F')
						{				
							echo "<option value=\"M\">Macho</option>";
							echo "<option selected=\"selected\" value=\"F\">Fêmea</option>";
						}
						else
						{
							echo "<option value=\"M\">Macho</option>";
							echo "<option value=\"F\">Fêmea</option>";													
						}

						echo "</select>
						</div>

						<legend>Informe as características</legend>
						
						<div class=\"controls controls-row\">
						<input class=\"span3\" type=\"text\" id=\"idade\" value=\"".$_GET['idade']."\" name=\"idade\" placeholder=\"Idade\" style=\"font-family:'museo_500regular';\">
						</div>
										
						<div class=\"controls controls-row\">																	
						<input class=\"span3\" type=\"text\" id=\"peso\" value=\"".$_GET['peso']."\" name=\"peso\" placeholder=\"Peso\" style=\"font-family:'museo_500regular';\">
						</div>


						<div class=\"controls controls-row\">		
						<label class=\"span2\">Porte</label>
						</div>
						
						<div class=\"controls controls-row\">						
						<select class=\"span3\" name=\"porte\" style=\"font-family:'museo_500regular';\">";
						
						if($_GET['porte'] == 'P')
						{						
							echo "<option selected=\"selected\" value=\"P\">Pequeno</option>";
							echo "<option value=\"M\">Médio</option>";
							echo "<option value=\"G\">Grande</option>";
						}
						else if($_GET['porte'] == 'M')
						{			
							echo "<option value=\"P\">Pequeno</option>";
							echo "<option selected=\"selected\" value=\"M\">Médio</option>";
							echo "<option value=\"G\">Grande</option>";											
						}
						else if($_GET['porte'] == 'G')
						{
							echo "<option value=\"P\">Pequeno</option>";
							echo "<option value=\"M\">Médio</option>";
							echo "<option selected=\"selected\" value=\"G\">Grande</option>";											
						}
						else
						{
							echo "<option value=\"P\">Pequeno</option>";
							echo "<option value=\"M\">Médio</option>";
							echo "<option value=\"G\">Grande</option>";													
						}						
							
						echo "</select>
						</div>
											
						<div class=\"controls controls-row\">
						<label class=\"span2\">Deficiente ?</label>
						<label class=\"span3\">Se sim, qual ?</label>
						</div>
											
						<div class=\"controls controls-row\">
						<select class=\"span2\" name=\"deficiente\" style=\"font-family:'museo_500regular';\">";
						
						if($_GET['deficiente'] == 'N')
						{													
							echo "<option selected=\"selected\" value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";
						}
						else if($_GET['deficiente'] == 'S')
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option selected=\"selected\" value=\"S\">Sim</option>";													
						}
						else
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";															
						}
										
						echo "<input class=\"span3\" type=\"text\" name=\"deficiencia\" value=\"".$_GET['deficiencia']."\" placeholder=\"Detalhes da deficiência\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</select>
						</div>

						<div class=\"controls controls-row\">
						<label class=\"span2\">Vacinado ?</label>
						<label class=\"span2\">Castrado ?</label>
						</div>

						<div class=\"controls controls-row\">
						<select class=\"span2\" name=\"vacinado\" style=\"font-family:'museo_500regular';\">";					

						if($_GET['vacinado'] == 'N')
						{					
							echo "<option selected=\"selected\" value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";
						}
						else if($_GET['vacinado'] == 'S')
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option selected=\"selected\" value=\"S\">Sim</option>";												
						}
						else
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";													
						}			
						
						echo "</select>
						<select class=\"span2\" name=\"castrado\" style=\"font-family:'museo_500regular';\">";					

						if($_GET['castrado'] == 'N')
						{						
							echo "<option selected=\"selected\" value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";
						}
						else if($_GET['castrado'] == 'S')
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option selected=\"selected\"value=\"S\">Sim</option>";												
						}
						else
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option value=\"S\">Sim</option>";														
						}
											
						echo "</select>
						</div>

						<legend>Informe mais sobre o animal</legend>

						<div class=\"controls controls-row\">
						<label class=\"span5\">Descrição</label>
						</div>
						<div class=\"controls controls-row\">
						<textarea rows=\"6\" class=\"span5\" name=\"descricao\" id=\"descricao\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\">".$_SESSION['descricaoanimal']."</textarea>
						</div>

						<legend>Insira imagens e vídeos do animal</legend>

						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem principal</label><input type=\"file\" class=\"span3\" name=\"imagem1\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem adicional</label><input type=\"file\" class=\"span3\" name=\"imagem2\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem adicional</label><input type=\"file\" class=\"span3\" name=\"imagem3\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem adicional</label><input type=\"file\" class=\"span3\" name=\"imagem4\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem adicional</label><input type=\"file\" class=\"span3\" name=\"imagem5\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\">Imagem adicional</label><input type=\"file\" class=\"span3\" name=\"imagem6\" style=\"font-family:'museo_500regular';\">
						</div>

						<div class=\"controls controls-row\">
						<label class=\"span5\">Vídeo</label>
						</div>

						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span5\" id=\"video1\" value=\"".$_GET['video1']."\" name=\"video1\" placeholder=\"http://www.youtube.com/watch?v=(Insira somente o ID)\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<div class=\"controls controls-row\">
						<label class=\"span5\">Vídeo adicional</label>
						</div>

						<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2097152\" />
						
						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span5\" id=\"video2\" name=\"video2\" value=\"".$_GET['video2']."\" placeholder=\"http://www.youtube.com/watch?v=(Insira somente o ID)\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<br />
						<button class=\"btn btn-large btn-primary\" type=\"submit\">Inserir animal</button>&nbsp;&nbsp;
						<button class=\"btn btn-large btn btn-danger\" Onclick='location.href=\"adminAccount.php\"' type=\"button\">Cancelar</button>
						</form><br /><br />";
						
						echo "</div><div class=\"span1\"></div></div></div>";
						
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
