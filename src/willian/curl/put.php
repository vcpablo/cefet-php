<?php

//curl localhost/cadastro/put.php -X PUT -d "nome=Nome&telefone=25220000"

$corpo = file_get_contents('php://input');
$_PUT = array();

mb_parse_str($corpo, $_PUT);
header("Content-Type: application/json");
echo json_encode($_PUT);

?>
