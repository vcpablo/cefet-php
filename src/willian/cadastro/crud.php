<?php

function get_data(){
	$corpo = file_get_contents('php://input');
	$array = array();
	mb_parse_str($corpo, $array);	
	return $array;
}

$method = mb_strtoupper($_SERVER['REQUEST_METHOD']);

$action = '';
$nome = '';
$telefone = '';

switch($method){
	case 'POST':
		$action = 'Cadastrado';
		$nome = $_POST['nome'];
		$telefone = $_POST['telefone'];	
		break;
	case 'GET':		
		$nome = $_GET['nome'];
		$telefone = $_GET['telefone'];	
		break;
	case 'PUT':
		$action = 'Alterado';
		$_PUT = get_data();
		$nome = $_PUT['nome'];
		$telefone = $_PUT['telefone'];
		break;
	case 'DELETE':
		$action = 'Apagado';
		$_DELETE = get_data();
		$nome = $_DELETE['nome'];
		$telefone = $_DELETE['telefone'];
		break;
}

$data = json_encode((object)["action" => $action, "nome" => $nome, "telefone" => $telefone]);

header("Content-Type: application/json");

echo $data;

?>