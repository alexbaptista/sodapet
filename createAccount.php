<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="title" content="SóDáPet - Sistema online de divulgação para adoção Pet" />
		<meta name="url" content="www.sodapet.org" />
		<meta name="description" content="Sistema especializado para a divulgação de animais abrigados em entidades não-governamentais." />
		<meta name="keywords" content="ong, animal, abandono, cão, gato, cachorro" />
		<meta name="charset" content="UTF-8" />
		<?php include 'sodapet.elements/head.php' ?>
		<script type="text/javascript">
			function getEndereco() {
				// Se o campo CEP não estiver vazio
				if($.trim($("#cep").val()) != ""){
				/*
				Para conectar no serviço e executar o json, precisamos usar a função
				getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
				dataTypes não possibilitam esta interação entre domínios diferentes
				Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
				http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
				*/
				$.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
				// o getScript dá um eval no script, então é só ler!
				//Se o resultado for igual a 1
						
				if (resultadoCEP["tipo_logradouro"] != '') {
					if (resultadoCEP["resultado"]) {
					// troca o valor dos elementos
						$("#endereco").val(unescape(resultadoCEP["tipo_logradouro"]) + " " + unescape(resultadoCEP["logradouro"]));
						$("#bairro").val(unescape(resultadoCEP["bairro"]));
						$("#cidade").val(unescape(resultadoCEP["cidade"]));
						$("#estado").val(unescape(resultadoCEP["uf"]));
						$("#numero").focus();
						}
					}		
				});
				}
			}
		</script>
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
				// Início da sessão
				session_start();							
				
				$type = $_GET['type'];
				$term = $_GET['term'];
				
				if ($term == 'yes')
				{

					switch($type)
					{
						case 'user':
								
						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\">";

						if($_GET['erro'] == 'cpf'){

							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>CPF informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'email')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Email informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'bd')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

						}

						echo "<form id=\"createUserAccount\" method=\"post\" action=\"sodapet.control/processCreateAccount.class.php\">
						<input type=\"hidden\" name=\"type\" value=\"user\" >

						<legend>Informe os seus dados pessoais</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$_GET['nomecompleto']."\" name=\"nomecompleto\" placeholder=\"Nome completo\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						<div class=\"controls controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['cpf']."\" id=\"cpf\" name=\"cpf\" placeholder=\"CPF\" style=\"font-family:'museo_500regular';\">
						</div>
						<div class=\"controls controls\">
						<input type=\"text\" class=\"span2\" value=\"".$_GET['datanascimento']."\" id=\"datanascimento\" name=\"datanascimento\" placeholder=\"Data de nascimento\" style=\"font-family:'museo_500regular';\" >
						</div>
						<div class=\"controls controls-row\">
						<label class=\"span2\" style=\"font-family:'museo_500regular';\">Sexo</label>
						<label class=\"span3\" style=\"font-family:'museo_500regular';\">Estado civil</label>
						</div>
						<div class=\"controls controls-row\">
						<select class=\"span2\" name=\"Sexo\" style=\"font-family:'museo_500regular';\">";

						if($_GET['Sexo'] == 'M')
						{
							echo "<option selected=\"selected\" value=\"M\">Masculino</option>";
							echo "<option value=\"F\">Feminino</option>";
						}
						else if($_GET['Sexo'] == 'F')
						{
							echo "<option value=\"M\">Masculino</option>";
							echo "<option selected=\"selected\" value=\"F\">Feminino</option>";
						}
						else
						{
							echo "<option value=\"M\">Masculino</option>";
							echo "<option value=\"F\">Feminino</option>";
						}


						echo "</select>											
						<select class=\"span3\" name=\"estadocivil\" style=\"font-family:'museo_500regular';\">";

						if($_GET['estadocivil'] == 'SOLTEIRO')
						{
							echo "<option selected=\"selected\" value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($_GET['estadocivil'] == 'CASADO')
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option selected=\"selected\" value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($_GET['estadocivil'] == 'DIVORCIADO')
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option selected=\"selected\" value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($_GET['estadocivil'] == 'VIUVO')
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option selected=\"selected\" value=\"VIUVO\">Viúvo(a)</option>";
						}
						else
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}

						echo "</select>
						</div>

						<legend>Informe os seus dados residenciais</legend>

<div class=\"controls\">
						<input class=\"span3 inputs\" type=\"text\" onblur=\"getEndereco()\" value=\"".$_GET['cep']."\" id=\"cep\" name=\"cep\" placeholder=\"CEP\" style=\"font-family:'museo_500regular';\">						</div>
						<div class=\"controls\">
						<input class=\"span5\" type=\"text\" id=\"endereco\" value=\"".$_GET['endereco']."\" name=\"endereco\" placeholder=\"Endereço\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>			
						<div class=\"controls\">
						<input class=\"span2\" type=\"text\" id=\"numero\" value=\"".$_GET['numero']."\" name=\"numero\" placeholder=\"Número\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
						<div class=\"controls\">
						<input class=\"span3\" type=\"text\" value=\"".$_GET['complemento']."\" name=\"complemento\" placeholder=\"Complemento\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span2\" value=\"".$_GET['bairro']."\" id=\"bairro\" name=\"bairro\" placeholder=\"Bairro\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['cidade']."\" id=\"cidade\" name=\"cidade\" placeholder=\"Cidade\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"text\" class=\"span1\" value=\"".$_GET['estado']."\" id=\"estado\" name=\"estado\" placeholder=\"Estado\" style=\"font-family:'museo_500regular';\" maxlength=\"2\">
						</div>

						<legend>Informe os seus contatos</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['telefoneresidencial']."\" id=\"telefoneresidencial\" name=\"telefoneresidencial\" placeholder=\"Telefone Residencial\" style=\"font-family:'museo_500regular';\">						
						</div>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['telefonemovel']."\" id=\"telefonemovel\" name=\"telefonemovel\" placeholder=\"Telefone Móvel\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['idfacebook']."\" name=\"idfacebook\" placeholder=\"ID Facebook\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">						
						</div>
						
						<div class=\"controls\">					
						<input type=\"text\" class=\"span3\" value=\"".$_GET['idtwitter']."\" name=\"idtwitter\" placeholder=\"ID Twitter\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<legend>Informe mais sobre você</legend>

						<div class=\"controls controls-row\">
						<label class=\"span2\">Prefência por</label>
						<label class=\"span3\">Tipo de moradia</label>
						</div>
						<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\"class=\"span2\" name=\"preferenciaanimal\">";
						
						if($_GET['preferenciaanimal'] == 'CAO')
						{
							echo "<option selected=\"selected\" value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";
						}
						else if($_GET['preferenciaanimal'] == 'GATO')
						{
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option selected=\"selected\" value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";
						}
						else if($_GET['preferenciaanimal'] == 'AMBOS')
						{
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option selected=\"selected\" value=\"AMBOS\">Ambos</option>";
						}
						else
						{
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";
						}

						echo "</select>
						<select style=\"font-family:'museo_500regular';\" class=\"span3\" name=\"tipomoradia\">";

						if($_GET['tipomoradia'] == 'CASA')
						{
							echo "<option selected=\"selected\" value=\"CASA\">Casa</option>";
							echo "<option value=\"APARTAMENTO\">Apartamento</option>";
						}
						else if($_GET['tipomoradia'] == 'APARTAMENTO')
						{
							echo "<option value=\"CASA\">Casa</option>";
							echo "<option selected=\"selected\" value=\"APARTAMENTO\">Apartamento</option>";
						}
						else
						{
							echo "<option value=\"CASA\">Casa</option>";
							echo "<option value=\"APARTAMENTO\">Apartamento</option>";
						}

						echo "</select>
						</div>
						<div class=\"controls controls-row\">
						<label class=\"span2\">Já dotou algum animal ?</label>
						</div>
						<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\" class=\"span2\" name=\"adotouanimal\">";

						if($_GET['adotouanimal'] == 'N')
						{
							echo "<option selected=\"selected\" value=\"N\">Não</option>";
							echo "<option value=\"S\">SIm</option>";
						}
						else if($_GET['adotouanimal'] == 'S')
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option selected=\"selected\" value=\"S\">Sim</option>";
						}
						else
						{
							echo "<option value=\"N\">Não</option>";
							echo "<option value=\"S\">SIm</option>";
						}

						echo "</select>
						</div>

						<legend>Defina o seu acesso</legend>

						<div class=\"controls controls-row\">
						<input class=\"span4\" type=\"text\" value=\"".$_GET['email']."\" name=\"email\" placeholder=\"Email\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>								
						<div class=\"controls\">
						<input class=\"span3\" type=\"password\" id=\"senha\" name=\"senha\" placeholder=\"Senha de 4 á 8 dígitos\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
						<div class=\"controls\">
						<input class=\"span3\" type=\"password\" id=\"senhaconfirm\" name=\"senhaconfirm\" placeholder=\"Confirmação da senha\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">	</div>
						<br />
						<button class=\"btn btn-large btn-primary\" type=\"submit\">Criar minha conta</button>
						&nbsp;&nbsp;
						<button class=\"btn btn-large btn btn-danger\" Onclick='location.href=\"index.php\"' type=\"button\">Cancelar</button>
						</form>
						</div>
						<div class=\"span1\"></div>
						</div>
						</div>";

						break;

						case 'ong':

						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\">";
						

						if($_GET['erro'] == 'cnpj'){

							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>CNPJ informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'email')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Email informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'bd')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

						}
						else if($_GET['erro'] == 'imgtamanho')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Tamanho excedido - Insira uma imagem de até 2MB (JPG)</div>";

						}
						else if($_GET['erro'] == 'imgformato')
						{
						
							echo "<br/><div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Formato inválido - Insira uma imagem no formato JPEG</div>";

						}

						echo "<form id=\"createOngAccount\" enctype=\"multipart/form-data\" method=\"post\" action=\"sodapet.control/processCreateAccount.class.php\">
						<input type=\"hidden\" name=\"type\" value=\"ong\" >

						<legend>Informe os dados de sua Ong</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$_GET['nomefantasia']."\" name=\"nomefantasia\" placeholder=\"Nome Fantasia\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$_GET['cnpj']."\" id=\"cnpj\" name=\"cnpj\" placeholder=\"CNPJ\" style=\"font-family:'museo_500regular';\" >
						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$_GET['razaosocial']."\" name=\"razaosocial\" placeholder=\"razaosocial\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>
						
						<legend>Informe o endereço de sua Ong</legend>

						<div class=\"controls\">
						<input class=\"span3 inputs\" value=\"".$_GET['cep']."\" type=\"text\" onblur=\"getEndereco()\" id=\"cep\" name=\"cep\" placeholder=\"CEP\" style=\"font-family:'museo_500regular';\">						</div>
						<div class=\"controls\">
						<input class=\"span5\" value=\"".$_GET['endereco']."\" type=\"text\" id=\"endereco\" name=\"endereco\" placeholder=\"Endereço\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>			
						<div class=\"controls\">
						<input class=\"span2\" type=\"text\" value=\"".$_GET['numero']."\" id=\"numero\" name=\"numero\" placeholder=\"Número\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
						<div class=\"controls\">
						<input class=\"span3\" type=\"text\" value=\"".$_GET['complemento']."\" name=\"complemento\" placeholder=\"Complemento\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span2\" value=\"".$_GET['bairro']."\" id=\"bairro\" name=\"bairro\" placeholder=\"Bairro\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['cidade']."\" id=\"cidade\" name=\"cidade\" placeholder=\"Cidade\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"text\" class=\"span1\" value=\"".$_GET['estado']."\" id=\"estado\" name=\"estado\" placeholder=\"Estado\" style=\"font-family:'museo_500regular';\" maxlength=\"2\">
						</div>

						<legend>Informe os contatos de sua Ong</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['telefonecomercial']."\" id=\"telefonecomercial\" name=\"telefonecomercial\" placeholder=\"Telefone Comercial\" style=\"font-family:'museo_500regular';\">						
						</div>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['telefonemovel']."\" id=\"telefonemovel\" name=\"telefonemovel\" placeholder=\"Telefone Móvel\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$_GET['idfacebook']."\" name=\"idfacebook\" placeholder=\"ID Facebook\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">						
						</div>
						
						<div class=\"controls\">					
						<input type=\"text\" class=\"span3\" value=\"".$_GET['idtwitter']."\" name=\"idtwitter\" placeholder=\"ID Twitter\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$_GET['website']."\" name=\"website\" placeholder=\"Web Site\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<legend>Informe mais sobre sua Ong</legend>

						<label>Descrição</label>
						<div class=\"controls controls-row\">
						<textarea rows=\"6\" class=\"span5\" id=\"descricao\" name=\"descricao\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\">".$_SESSION['descricaoong']."</textarea>
						</div>

						<label>Especialidade</label>

						<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\"class=\"span4\" name=\"especialidade\">";

						if($_GET['especialidade'] == 'CAO')
						{

							echo "<option value=\"CAO\" selected=\"selected\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";

						}
						else if($_GET['especialidade'] == 'GATO')
						{
						
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\" selected=\"selected\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";

						}
						else if($_GET['especialidade'] == 'AMBOS')
						{

							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\" selected=\"selected\">Ambos</option>";

						}
						else
						{

							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";

						}

						echo "</select>
						</div>

						<label>Logotipo</label>

						<div class=\"controls controls-row\">
						<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2097152\" />
						<input type=\"file\" name=\"logotipo\" placeholder=\"Logotipo\" style=\"font-family:'museo_500regular';\">
						</div>

						<label>Tamanho máximo de arquivo 2MB (*.JPG)</label>

						<legend>Defina o seu acesso</legend>

						<div class=\"controls controls-row\">
						<input class=\"span4\" value=\"".$_GET['email']."\" type=\"text\" name=\"email\" placeholder=\"Email\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>								
						<div class=\"controls\">
						<input class=\"span3\" type=\"password\" id=\"senha\" name=\"senha\" placeholder=\"Senha de 4 á 8 dígitos\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
						<div class=\"controls\">
						<input class=\"span3\" type=\"password\" id=\"senhaconfirm\" name=\"senhaconfirm\" placeholder=\"Confirmação da senha\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">						</div>
						<br />
						<button class=\"btn btn-large btn-primary submit\" type=\"submit\" >Criar minha conta</button>
						&nbsp;&nbsp;
						<button class=\"btn btn-large btn btn-danger\"  Onclick='location.href=\"index.php\"' type=\"button\">Cancelar</button>
						</form>
						

						</div>
						<div class=\"span1\"></div>
						</div>
						</div>";

						break;

						default:

						echo "<div class=\"container-fluid\">
						<div class=\"row-fluid navbar-inner\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br /><br /><br /><br />
						<h1 align=\"center\">Criar conta no SóDáPet</h1>
						<br />
						<p align=\"center\">
						<button class=\"btn btn-large btn btn-primary\" type=\"button\" Onclick=\"location.href='createAccount.php?type=ong&term=yes'\">&nbsp;&nbsp;&nbsp;Ongs&nbsp;&nbsp;&nbsp;</button>
						<button class=\"btn btn-large btn btn-primary\" type=\"button\" Onclick=\"location.href='createAccount.php?type=user&term=yes'\">Usuários</button>
						</p>
						<br />
						<h3 align=\"center\">Qual o perfil desejado ?</h3>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						</div>
						<div class=\"span1\"></div>
						</div>
						</div>";
	
						break;	
					}
				}
				else
				{
					header('Location: ../');

				}
			session_destroy();
			?>
			</div>
			<div class="footer_shawdow"></div>
			<div class="footer">
				<?php include 'sodapet.elements/footer.php'?>
			</div>
		</div>
	</body>
</html>
