<?php

header("Content-Type: application/xml");

$nome = isset($_GET['nome']) ? $_GET['nome'] : 'Nome não informado';
$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : 'Telefone não informado';

echo <<<XML
<contato>
<nome>$nome</nome>
<telefone>$telefone</telefone>
</contato>
XML;

?>