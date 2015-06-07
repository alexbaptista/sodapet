<?php
/* 
* Classe showBrand
* Classe responsável pela a exibição de logotipo das contas do tipo ONG
*/

/*
* função __autoload
* Para carregar as classes necessárias da camada "model" para a execução das operações de forma tem.
*/
function __autoload($classe)
{
    if (file_exists("../sodapet.model/{$classe}.class.php"))
    {
        include_once "../sodapet.model/{$classe}.class.php";
    }
    else if (file_exists("../sodapet.model/sodapet.ado/{$classe}.class.php"))
    {
        include_once "../sodapet.model/sodapet.ado/{$classe}.class.php";
    }
}

// Váriavel irá armazenar qual o email será usado para a busca
$cnpjOng = $_GET['idlogo'];

// Carregamento das informações do banco de dados
$contaOng = OperationAccount::loadBrandOng($cnpjOng);

// Cabeçalho ajustado para a exibição de imagens
header("Content-type: image/jpeg");

// Impressão da imagem localizada
echo $contaOng[0];
?>
