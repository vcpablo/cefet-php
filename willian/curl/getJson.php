<?php

header("Content-Type: application/json");

$nome = isset($_GET['nome']) ? $_GET['nome'] : 'Nome não informado';
$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : "Telefone não informado";

$json = '{\"nome\": \"$nome\", \"telefone\": \"$telefone\"}';

echo $json;

?>