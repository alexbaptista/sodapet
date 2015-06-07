<?php
/* 
* Classe showImages
* Classe responsável pela a exibição das imagens do animal
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

// Váriavel irá armazenar quais os dados serão usados para a localização da imagem
$idAnimal = $_GET['animal'];

// Carregamento das informações do banco de dados
$dadosAnimal = OperationAnimal::loadInfoAnimalEdit($idAnimal);

// Cabeçalho ajustado para a exibição de imagens
header("Content-type: image/jpeg");

// Impressão da imagem
echo $dadosAnimal[17];
?>
