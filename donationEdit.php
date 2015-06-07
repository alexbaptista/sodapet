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
				$idTicket = $_GET['ticket'];
				
				// Verifica se o argumento do ticket foi passado por get
				if($idTicket != '')
				{
					
					// Verifica se há sessão ativa no sistema
					if(isset($_SESSION['tipo']))
					{
						
						// Verifica o tipo da sessão
						switch($_SESSION['tipo'])
						{
							case 'ONG':
							
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
								
								// Verifica á quem pertence o Ticket
								$verificaOrigemTicket = OperationDonation::checkTicketId($_SESSION['info'][0], $idTicket);
								
								// Verifica o resultado
								if($verificaOrigemTicket)
								{
									
									// verifica as informações do Ticket X
									$infoTicket = OperationDonation::loadInfoTicket($idTicket);
									
									// Instancia as informações consultadas no BD sobre o usuário
									$infoAccount = OperationAccount::loadInfoAccountUser($infoTicket[0][3]);
							
									echo "<div class=\"container-fluid navbar-inner\">
									<div class=\"row-fluid\">
									<div class=\"span1\"></div>
									<div class=\"span10\"><br />
									<div class=\"navbar\">
									<div class=\"navbar-inner\">
									<a class=\"brand\" href=\"adminAccount.php\">Home</a>
									<a class=\"brand\" href=\"adminDonations.php\">Minhas adoções</a>
									<a class=\"brand\">Ticket #".$idTicket."</a>
									<ul class=\"nav\">
									<li class=\"active\"><a href=\"donationEdit.php?ticket=".$idTicket."\">Edição</a></li>
									</ul>
									</div></div>";
									
									if($_GET['statusticket'] == 500)
									{

										echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Não é mais possível modificar o status deste Ticket</div>";

									}
									else if($_GET['statusticket'] == 404)
									{

										echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Houve um erro temporário nesta solicitação, por favor tente novamente</div>";

									}
									else if($_GET['statusticket'] == 200)
									{

										echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>O Ticket foi atualizado com sucesso</div>";

									}
																
									echo "<form id=\"updateTicket\" name=\"updateTicket\" method=\"post\" action=\"sodapet.control/processUpdateTicket.class.php\">";
									
									echo "<legend>Dados do requisitante</legend>";
									
									echo "<p>Nome completo: <b>".$infoAccount[2]."</b></p>";
									echo "<p>CPF: <b>".substr($infoAccount[1],0,3).".".substr($infoAccount[1],3,3).".".substr($infoAccount[1],6,3)."-".substr($infoAccount[1],9,2)."</b></p>";
									echo "<p>Data de nascimento: <b>".substr($infoAccount[3],8,2)."/".substr($infoAccount[3],5,2)."/".substr($infoAccount[3],0,4)."</b></p>";
									echo "<p>Sexo: <b>".$infoAccount[4]."</b></p>";
									echo "<p>Estado civil: <b>".$infoAccount[5]."</b></p>";

									echo "<legend>Endereço</legend>";
																		
									echo "<p>Cep: <b>".$infoAccount[12]."</b></p>";
									echo "<p>Endereço: <b>".$infoAccount[9]."</b></p>";
									echo "<p>Número: <b>".$infoAccount[10]."</b></p>";
									echo "<p>Complemento: <b>".$infoAccount[11]."</b></p>";
									echo "<p>Bairro: <b>".$infoAccount[13]."</b></p>";
									echo "<p>Cidade: <b>".$infoAccount[14]."</b></p>";
									echo "<p>Estado: <b>".$infoAccount[15]."</b></p>";									

									echo "<legend>Contatos</legend>";
									
									echo "<p>Telefone residencial: <b>(".substr($infoAccount[16],2,2).") ".substr($infoAccount[16],4,4)."-".substr($infoAccount[16],8,4)."</b></p>";
									echo "<p>Telefone móvel: <b>(".substr($infoAccount[17],2,2).") ".substr($infoAccount[17],4,4)."-".substr($infoAccount[17],8,4)."</b></p>";
									echo "<p>Facebook: <b>".$infoAccount[18]."</b></p>";
									echo "<p>Twitter: <b>".$infoAccount[19]."</b></p>";									

									echo "<legend>Motivo descrito pelo usuário</legend>";
									
									echo "<div class=\"controls controls-row\">";
									echo "<textarea readonly=\"readonly\" rows=\"6\" class=\"span5\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\">".$infoTicket[0][7]."</textarea>";
									echo "</div>";
																		
									echo "<legend>Informações para a atualização do Ticket</legend>";
									
									echo "<div class=\"controls controls-row\">";
									echo "<label class=\"span5\">Status do Ticket</label>";
									echo "</div>";
										
									echo "<div class=\"controls controls-row\">";
									echo "</select><select class=\"span2\" name=\"status\" style=\"font-family:'museo_500regular';\">";
									
									if($infoTicket[0][4] == 'PENDENTE')
									{

										echo "<option value=\"ANALISE\">Análise</option>";
										echo "<option value=\"APROVADO\">Aprovado</option>";
										echo "<option value=\"CANCELADO\">Cancelado</option>";
																		
									}
									else if($infoTicket[0][4] == 'APROVADO')
									{
										
										echo "<option value=\"ANALISE\">Análise</option>";
										echo "<option selected=\"selected\" value=\"APROVADO\">Aprovado</option>";
										echo "<option value=\"CANCELADO\">Cancelado</option>";										
										
									}
									else if($infoTicket[0][4] == 'CANCELADO')
									{
										
										echo "<option value=\"ANALISE\">Análise</option>";
										echo "<option value=\"APROVADO\">Aprovado</option>";
										echo "<option selected=\"selected\" value=\"CANCELADO\">Cancelado</option>";										
										
									}
									else if($infoTicket[0][4] == 'ANALISE')
									{
										
										echo "<option selected=\"selected\" value=\"ANALISE\">Análise</option>";
										echo "<option value=\"APROVADO\">Aprovado</option>";
										echo "<option value=\"CANCELADO\">Cancelado</option>";									
										
									}									
																	
									echo "</select>";
									echo "</div>";
																									
									echo "<div class=\"controls controls-row\">";
									echo "<label class=\"span5\">Status da requisição</label>";
									echo "</div>";
										
									echo "<div class=\"controls controls-row\">";
									echo "<textarea rows=\"6\" class=\"span5\" id=\"descricao\" name=\"descricao\" style=\"font-family:'museo_500regular';\" maxlength=\"1024\">".$infoTicket[0][6]."</textarea>";
									echo "</div><br />";

									echo "<input type=\"hidden\" name=\"idticket\" 	value=\"".$idTicket."\" />";
									echo "<input type=\"hidden\" name=\"emailong\" 	value=\"".$_SESSION['info'][0]."\" />";									
										
									echo "<button class=\"btn btn-large btn-primary\" type=\"submit\">Atualizar Ticket</button>&nbsp;&nbsp;";
									echo "<button class=\"btn btn-large btn btn-danger\" Onclick='location.href=\"adminDonations.php\"' type=\"button\">Cancelar</button>";																							
									
									echo "</form>";
									echo "</div><div class=\"span1\"></div></div></div>";
									
								}
								else
								{
									
									header('Location: adminDonations.php');
														
								}
							
							
							break;
							
							default:
							
								header('Location: index.php');
							
							break;
						}
						
					}
					else
					{
						
						include 'sodapet.elements/restrict.php';
						
					}
				}
				else
				{
					
					header('Location: adminDonations.php');
					
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
