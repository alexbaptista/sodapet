<?php
session_start();

	echo "<div class=\"header_login\"><br />";

	if(isset($_SESSION['tipo']))
	{
		if($_SESSION['tipo'] == 'ONG')
		{
			echo "<div class=\"btn-group\">
		        <button class=\"btn btn-large\" style=\"font-family:'museo_500regular'\">" . $_SESSION['info'][3] . "</button>
		        <button class=\"btn btn-large dropdown-toggle btn-danger\" data-toggle=\"dropdown\"><span class=\"caret\"></span></button>
		        <ul class=\"dropdown-menu\" style=\"margin-left:30%;\">
		        <li><a href=\"adminAccount.php\">Painel de Administração</a></li>
			<li class=\"divider\"></li>
		        <li><a href=\"editAccount.php\">Editar conta</a></li>
		        <li><a href=\"adminDonations.php\">Minhas doações</a></li>
			<li class=\"divider\"></li>
			<li><a href=\"adminPets.php\">Meus pets</a></li>
			<li><a href=\"adminPetsRegistered.php\">Animais cadastrados</a></li>
			<li><a href=\"adminPetsNew.php\">Novo animal</a></li>
		        <li class=\"divider\"></li>
		        <li><a href=\"sodapet.control/logout.class.php\">Sair&nbsp;&nbsp;<i class=\"icon-search icon-off\"></i></a></li>
		        </ul>
			</div><br /><br />";
		}
		else if($_SESSION['tipo'] == 'USUARIO')
		{
			echo "<div class=\"btn-group\">
		        <button class=\"btn btn-large\" style=\"font-family:'museo_500regular'\">" . $_SESSION['info'][2] . "</button>
		        <button class=\"btn btn-large dropdown-toggle btn-danger\" data-toggle=\"dropdown\"><span class=\"caret\"></span></button>
		        <ul class=\"dropdown-menu\"  style=\"margin-left:30%;\">
		        <li><a href=\"adminAccount.php\">Painel de Administração</a></li>
			<li class=\"divider\"></li>
		        <li><a href=\"editAccount.php\">Editar conta</a></li>
		        <li><a href=\"adminDonations.php\">Minhas adoções</a></li>
		        <li class=\"divider\"></li>
		        <li><a href=\"sodapet.control/logout.class.php\">Sair&nbsp;&nbsp;<i class=\"icon-search icon-off\"></i></a></li>
		        </ul>
			</div><br /><br />";
		}
	}
	else
	{
		echo "<form name=\"login\" method=\"post\" action=\"sodapet.control/logon.class.php\" class=\"form-inline\">
		<input type=\"text\" name=\"email\" maxlength=\"50\" class=\"input-small input-medium\" style=\"font-family:'museo_500regular'\" placeholder=\"Email\">
		<input type=\"password\" name=\"senha\" maxlength=\"8\" class=\"input-small input-medium\" style=\"font-family:'museo_500regular'\" placeholder=\"Senha\">
		<input type=\"submit\" value=\"Acessar\" class=\"btn btn-danger\" style=\"font-family:'museo_500regular'\">
		<a href=\"term.php\" class=\"btn btn-link\">Criar conta</a>|<a href=\"recoveryPassword.php\" class=\"btn btn-link\">Recuperar senha</a>
		</form>";
	}
	
	ob_start();
	
	echo "<form name=\"search\" method=\"get\" action=\"search.php\" class=\"form-search\"><div class=\"input-append\">
	<input type=\"text\" name=\"search\" style=\"width:100px\" id=\"search\" value=\"".$_GET['search']."\" class=\"span2 search-query\" placeholder=\"Busca\" style=\"font-family:'museo_500regular'\"/>
	<button style=\"font-family:'museo_500regular'\" type=\"submit\" class=\"btn btn-danger\">Buscar</button>
	</div></form><br />";
	
	if($_GET['status'] == 404)
	{
		echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>Email informado não existe</div>";
	}
	else if($_GET['status'] == 500)
	{
		echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>A conta está temporariamente bloqueada</div>";
	}
	else if($_GET['status'] == 403)
	{
		echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Erro ! - </strong>A senha está incorreta</div>";
	}
	else if($_GET['status'] == 200)
	{
		echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>Sucesso ! - </strong>Bem vindo ao SóDáPet.org</div>";
	}
	
	echo "</div><a href=\"#\"><img src=\"sodapet.images/logo_sodapet_home_1.png\" class=\"logo_home\" onmouseover=\"this.src='sodapet.images/logo_sodapet_home.png'\" onmouseout=\"this.src='sodapet.images/logo_sodapet_home_1.png'\"/></a>";
	
?>
