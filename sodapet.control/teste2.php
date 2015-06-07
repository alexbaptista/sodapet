<?php
$logotipo = file_get_contents($_FILES['logotipo']['tmp_name']);
$sizeData = getimagesize($_FILES['logotipo']['tmp_name']);
$tipo_foto_usuarios = $sizeData['mime'];

//header("Content-type: $tipo_foto_usuarios");

//echo $logotipo;
var_dump($_FILES['logotipo']);

echo "<br>";

echo $_FILES['logotipo']['size'];
?>
