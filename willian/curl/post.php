<?php

//curl localhost/php/curl/post.php -X POST -d "nome=Willian&telefone=25229900"

header("Content-Type: text/html");

$nome = isset($_POST['nome']) ? $_POST['nome'] : 'Nome não informado';
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : 'Telefone não informado';

echo <<<HTML
<address>
$nome, $telefone
</address>
HTML;

?>
