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

				if (isset($_SESSION['tipo']))
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
						case 'USUARIO':
						
						// Instancia as informações consultadas no BD sobre o usuário
						$infoAccount = OperationAccount::loadInfoAccountUser($_SESSION['info'][0]);

						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />
						<div class=\"navbar\">
						  <div class=\"navbar-inner\">
						    <a class=\"brand\" href=\"adminAccount.php\">Home</a>
						    <ul class=\"nav\">
						      <li class=\"active\"><a href=\"editAccount.php?type=user\">Edição de conta</a></li>
						    </ul>
						  </div>
						</div>";
						
						if($_GET['erro'] == 'cpf'){

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>CPF informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'email')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Email informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'bd')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

						}
						else if($_GET['success'] == 'yes')
						{
						
							echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Dados da conta atualizados com sucesso</div>";

						}
												
						echo "<form id=\"editUserAccount\" method=\"post\" action=\"sodapet.control/processUpdateAccount.class.php\">
						<input type=\"hidden\" name=\"type\" value=\"user\" >
						
						<legend>Altere os seus dados pessoais</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"" . $infoAccount[2] . "\" name=\"nomecompleto\" placeholder=\"Nome completo\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"" . $infoAccount[1] . "\"name=\"cpf\" id=\"cpf\" placeholder=\"CPF\" style=\"font-family:'museo_500regular';\" >
						</div>						

						<div class=\"controls\">					
						<input type=\"text\" class=\"span2\" value=\"" . substr(str_replace('-','',$infoAccount[3]),'6','2').substr(str_replace('-','',$infoAccount[3]),'4','2').substr(str_replace('-','',$infoAccount[3]),'0','4') . "\"name=\"datanascimento\" id=\"datanascimento\" placeholder=\"Data de nascimento\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span2\" style=\"font-family:'museo_500regular';\">Sexo</label>
						<label class=\"span3\" style=\"font-family:'museo_500regular';\">Estado civil</label>
						</div>
						<div class=\"controls controls-row\">
						<select class=\"span2\" name=\"Sexo\" style=\"font-family:'museo_500regular';\">";
						
						if($infoAccount[4] == 'M')
						{
							echo "<option selected=\"selected\" value=\"M\">Masculino</option>";
							echo "<option value=\"F\">Feminino</option>";
						}
						else if($infoAccount[4] == 'F')
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

						if($infoAccount[5] == 'SOLTEIRO')
						{
							echo "<option selected=\"selected\" value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($infoAccount[5] == 'CASADO')
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option selected=\"selected\" value=\"CASADO\">Casado(a)</option>";
							echo "<option value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($infoAccount[5] == 'DIVORCIADO')
						{
							echo "<option value=\"SOLTEIRO\">Solteiro(a)</option>";
							echo "<option value=\"CASADO\">Casado(a)</option>";
							echo "<option selected=\"selected\" value=\"DIVORCIADO\">Divorciado(a)</option>";
							echo "<option value=\"VIUVO\">Viúvo(a)</option>";
						}
						else if($infoAccount[5] == 'VIUVO')
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

						<legend>Altere os seus dados residenciais</legend>

						<div class=\"controls\">
						<input class=\"span2 inputs\" type=\"text\" onblur=\"getEndereco()\"  id=\"cep\" value=\"" . $infoAccount[12] . "\" name=\"cep\" placeholder=\"CEP\" style=\"font-family:'museo_500regular';\" >
						</div>
												
						<div class=\"controls\">
						<input class=\"span5\" type=\"text\" id=\"endereco\" value=\"" . $infoAccount[9] . "\" name=\"endereco\" placeholder=\"Endereço\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>			

						<div class=\"controls\">
						<input class=\"span2\" type=\"text\" id=\"numero\" value=\"" . $infoAccount[10] . "\" name=\"numero\" placeholder=\"Número\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
											
						<div class=\"controls\">
						<input class=\"span3\" type=\"text\" name=\"complemento\" value=\"" . $infoAccount[11] . "\" placeholder=\"Complemento\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls\">
						<input type=\"text\" class=\"span2\" id=\"bairro\" value=\"" . $infoAccount[13] . "\" name=\"bairro\" placeholder=\"Bairro\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>						
						
						<div class=\"controls controls-row\">					
						<input type=\"text\" class=\"span3\" id=\"cidade\" value=\"" . $infoAccount[14] . "\" name=\"cidade\" placeholder=\"Cidade\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"text\" class=\"span1\" id=\"estado\" value=\"" . $infoAccount[15] . "\" name=\"estado\" placeholder=\"Estado\" style=\"font-family:'museo_500regular';\" maxlength=\"2\">
						</div>

						<legend>Altere os seus contatos</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"" . substr($infoAccount[16],'2','10') . "\" id=\"telefoneresidencial\" name=\"telefoneresidencial\" placeholder=\"Telefone Residencial\" style=\"font-family:'museo_500regular';\" >
						</div>
										
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"" . substr($infoAccount[17],'2','10') . "\" id=\"telefonemovel\" name=\"telefonemovel\" placeholder=\"Telefone Móvel\" style=\"font-family:'museo_500regular';\" >
						</div>
										
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"" . $infoAccount[18] . "\" name=\"idfacebook\" placeholder=\"ID Facebook\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">						
						</div>
				
						<div class=\"controls\">												
						<input type=\"text\" class=\"span3\" value=\"" . $infoAccount[19] . "\" name=\"idtwitter\" placeholder=\"ID Twitter\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<legend>Informe mais sobre você</legend>

						<div class=\"controls controls-row\">
						<label class=\"span2\">Prefência por</label>
						<label class=\"span3\">Tipo de moradia</label>
						</div>
						<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\"class=\"span2\" name=\"preferenciaanimal\">";
						
						if($infoAccount[7] == 'CAO')
						{
							echo "<option selected=\"selected\" value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";
						}
						else if($infoAccount[7] == 'GATO')
						{
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option selected=\"selected\" value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";
						}
						else if($infoAccount[7] == 'AMBOS')
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

						if($infoAccount[6] == 'CASA')
						{
							echo "<option selected=\"selected\" value=\"casa\">Casa</option>";
							echo "<option value=\"apartamento\">Apartamento</option>";
						}
						else if($infoAccount[6] == 'APARTAMENTO')
						{
							echo "<option value=\"casa\">Casa</option>";
							echo "<option selected=\"selected\" value=\"apartamento\">Apartamento</option>";
						}
						else
						{
							echo "<option value=\"casa\">Casa</option>";
							echo "<option value=\"apartamento\">Apartamento</option>";
						}

						echo "</select>
						</div>
						<div class=\"controls controls-row\">
						<label class=\"span2\">Já dotou algum animal ?</label>
						</div>
						<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\" class=\"span2\" name=\"adotouanimal\">";

						if($infoAccount[8] == 'N')
						{
							echo "<option selected=\"selected\" value=\"N\">Não</option>";
							echo "<option value=\"S\">SIm</option>";
						}
						else if($infoAccount[8] == 'S')
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

						<legend>Altere o seu acesso</legend>

						<div class=\"controls controls-row\">
						<input class=\"span4\" type=\"text\" value=\"".$infoAccount[0]."\" name=\"email\" placeholder=\"Email\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"hidden\" value=\"".$infoAccount[0]."\" name=\"emailvalue\">
						</div>
												
						<div class=\"controls controls-row\">
						<input class=\"span3\" type=\"password\" id=\"senha\" name=\"senha\" placeholder=\"Senha de 4 á 8 dígitos\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>					
						
						<div class=\"controls controls-row\">					
						<input class=\"span3\" type=\"password\" id=\"senhaconfirm\" name=\"senhaconfirm\" placeholder=\"Confirmação da senha\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>						

						<br />
						<button class=\"btn btn-large btn-primary\" type=\"submit\">Alterar minha conta</button>
						&nbsp;&nbsp;
						<button class=\"btn btn-large btn btn-danger\" Onclick=\"location.href='index.php'\">Cancelar</button>
						</form><br />";
						
						echo "</div><div class=\"span1\"></div></div></div>";
						
						break;

						case 'ONG':

						// Instancia as informações consultadas no BD sobre o usuário
						$infoAccount = OperationAccount::loadInfoAccountOng($_SESSION['info'][0]);
						
						echo "<div class=\"container-fluid navbar-inner\">
						<div class=\"row-fluid\">
						<div class=\"span1\"></div>
						<div class=\"span10\"><br />";
							
						echo "<div class=\"navbar\">
						  <div class=\"navbar-inner\">
						    <a class=\"brand\" href=\"adminAccount.php\">Home</a>
						    <ul class=\"nav\">
						      <li class=\"active\"><a href=\"editAccount.php?type=ong\">Edição de conta</a></li>
						    </ul>
						  </div>
						</div>
						<form id=\"editOngAccount\" enctype=\"multipart/form-data\" method=\"post\" action=\"sodapet.control/processUpdateAccount.class.php\">
						<input type=\"hidden\" name=\"type\" value=\"ong\" >";
						
						if($_GET['erro'] == 'cnpj'){

							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>CNPJ informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'email')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Email informado já está em uso</div>";

						}
						else if($_GET['erro'] == 'bd')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário em sua solicitação, por favor tente novamente</div>";

						}
						else if($_GET['erro'] == 'imgtamanho')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Tamanho excedido - Insira uma imagem de até 2MB (JPG)</div>";

						}
						else if($_GET['erro'] == 'imgformato')
						{
						
							echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Formato inválido - Insira uma imagem no formato JPEG</div>";

						}
						else if($_GET['success'] == 'yes')
						{
						
							echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Dados da conta atualizados com sucesso</div>";

						}
								
						echo "<legend>Altere os dados de sua Ong</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$infoAccount[3]."\" name=\"nomefantasia\" placeholder=\"Nome Fantasia\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$infoAccount[1]."\" id=\"cnpj\" name=\"cnpj\" placeholder=\"CNPJ\" style=\"font-family:'museo_500regular';\">
						</div>
						<div class=\"controls\">
						<input type=\"text\" class=\"span5\" value=\"".$infoAccount[2]."\" name=\"razaosocial\" placeholder=\"razaosocial\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<legend>Altere o endereço de sua Ong</legend>

						<div class=\"controls\">
						<input class=\"span2 inputs\" onblur=\"getEndereco()\" type=\"text\" id=\"cep\" value=\"".$infoAccount[10]."\" name=\"cep\" placeholder=\"CEP\" style=\"font-family:'museo_500regular';\">
						</div>
												
						<div class=\"controls\">
						<input class=\"span5\" type=\"text\" id=\"endereco\" value=\"".$infoAccount[7]."\" name=\"endereco\" placeholder=\"Endereço\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>			

						<div class=\"controls\">
						<input class=\"span2\" type=\"text\" id=\"numero\" value=\"".$infoAccount[8]."\" name=\"numero\" placeholder=\"Número\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>
											
						<div class=\"controls\">
						<input class=\"span3\" type=\"text\" value=\"".$infoAccount[9]."\" name=\"complemento\" placeholder=\"Complemento\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>
						
						<div class=\"controls\">
						<input type=\"text\" class=\"span2\" id=\"bairro\" value=\"".$infoAccount[11]."\" name=\"bairro\" placeholder=\"Bairro\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						</div>						
						
						<div class=\"controls controls-row\">					
						<input type=\"text\" class=\"span3\" id=\"cidade\" value=\"".$infoAccount[12]."\" name=\"cidade\" placeholder=\"Cidade\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"text\" class=\"span1\" id=\"estado\" value=\"".$infoAccount[13]."\" name=\"estado\" placeholder=\"Estado\" style=\"font-family:'museo_500regular';\" maxlength=\"2\">
						</div>

						<legend>Altere os contatos de sua Ong</legend>

						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".substr($infoAccount[14],'2','10')."\" id=\"telefonecomercial\" name=\"telefonecomercial\" placeholder=\"Telefone Comercial\" style=\"font-family:'museo_500regular';\" >
						</div>
											
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".substr($infoAccount[15],'2','10')."\" id=\"telefonemovel\" name=\"telefonemovel\" placeholder=\"Telefone Móvel\" style=\"font-family:'museo_500regular';\" >
						</div>
											
						<div class=\"controls\">
						<input type=\"text\" class=\"span3\" value=\"".$infoAccount[16]."\" name=\"idfacebook\" placeholder=\"ID Facebook\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">						
						</div>
						
						<div class=\"controls\">												
						<input type=\"text\" class=\"span3\" value=\"".$infoAccount[17]."\" name=\"idtwitter\" placeholder=\"ID Twitter\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<div class=\"controls controls-row\">
						<input type=\"text\" class=\"span5\" value=\"".$infoAccount[18]."\" name=\"website\" placeholder=\"Web Site\" style=\"font-family:'museo_500regular';\" maxlength=\"100\">
						</div>

						<legend>Informe mais sobre sua Ong</legend>

						<div class=\"controls controls-row\">
						<label class=\"span5\">Descrição</label>
						</div>
						<div class=\"controls controls-row\">
						<textarea rows=\"6\" class=\"span5\" name=\"descricao\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\">".$infoAccount[4]."</textarea>
						</div>

						<div class=\"controls controls-row\">
						<label class=\"span2\">Especialidade</label>
						</div>
						
							<div class=\"controls controls-row\">
						<select style=\"font-family:'museo_500regular';\"class=\"span2\" name=\"especialidade\">";

						if($infoAccount[6] == 'CAO')
						{

							echo "<option value=\"CAO\" selected=\"selected\">Cão</option>";
							echo "<option value=\"GATO\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";

						}
						else if($infoAccount[6] == 'GATO')
						{
						
							echo "<option value=\"CAO\">Cão</option>";
							echo "<option value=\"GATO\" selected=\"selected\">Gato</option>";
							echo "<option value=\"AMBOS\">Ambos</option>";

						}
						else if($infoAccount[6] == 'AMBOS')
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
						
						<div class=\"controls controls-row\">															
						<label class=\"span3\">Logotipo</label>
						</div>

						<div class=\"controls controls-row\">
						<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"2097152\" />
						<input type=\"file\" class=\"span5\" name=\"logotipo\" placeholder=\"Logotipo\" style=\"font-family:'museo_500regular';\">
						</div>
						
						<div class=\"controls controls-row\">
						<label class=\"span5\">Tamanho máximo de arquivo 2MB (*.JPG)</label>
						</div>
						
						<div class=\"controls controls-row\">															
						<label class=\"span3\">Logotipo atual</label>
						</div>
						
						<div class=\"controls controls-row\">
						<img width=\"150px\" heigth=\"150px\" src=\"sodapet.control/showBrand.php?idlogo=".$infoAccount[1]."\" class=\"img-polaroid\"><br><br>		
						</div>						
						
						<legend>Altere o seu acesso</legend>

						<div class=\"controls controls-row\">
						<input class=\"span4\" type=\"text\" value=\"".$infoAccount[0]."\" name=\"email\" placeholder=\"Email\" style=\"font-family:'museo_500regular';\" maxlength=\"50\">
						<input type=\"hidden\" value=\"".$infoAccount[0]."\" name=\"emailvalue\">
						</div>
												
						<div class=\"controls controls-row\">
						<input class=\"span3\" type=\"password\" id=\"senha\" name=\"senha\" placeholder=\"Senha de 4 á 8 dígitos\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>					
						
						<div class=\"controls controls-row\">					
						<input class=\"span3\" type=\"password\" id=\"senhaconfirm\" name=\"senhaconfirm\" placeholder=\"Confirmação da senha\" style=\"font-family:'museo_500regular';\" maxlength=\"8\">
						</div>						

						<br />
						<button class=\"btn btn-large btn-primary\" type=\"submit\">Alterar minha conta</button>
						&nbsp;&nbsp;
						<button class=\"btn btn-large btn btn-danger\" Onclick=\"location.href='index.php'\">Cancelar</button>
						</form>";			

						echo "</div><div class=\"span1\"></div></div></div>";

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
