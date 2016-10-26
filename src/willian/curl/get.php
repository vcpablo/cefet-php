<?php

//curl localhost/php/curl/get.php -X GET -d "nome=Willian&telefone=25229900"

header("Content-Type: text/plain");

$nome = isset($_GET['nome']) ? $_GET['nome'] : 'Nome não informado';
$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : 'Telefone não informado';

echo 'Nome: ', $nome, PHP_EOL, 'Telefone: ', $telefone;

?>
