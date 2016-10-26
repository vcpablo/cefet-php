<?php

header("Content-Type: application/json");

// retorna um array com os dados do request
function getData(){
	$corpo = file_get_contents('php://input');
	$array = array();
	mb_parse_str($corpo, $array);

	return $array;
}



function checkParametros(){
	$dados = getData();
	if (!isset($dados['nome'])) {
		header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		die('O nome não foi informado.');
	}

	if (!isset($dados['telefone'])) {
		header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		die('O telefone não foi informado.');
	}
}



// retorna um objeto pessoa
function pessoaToObject($nome, $telefone){

	// validação
	$tamNome = mb_strlen($nome);

	if ($tamNome < 2 || $tamNome > 60) {
		//header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		header('HTTP/1.1 400 Bad Request');
		die('O nome deve ter entre 2 e 60 caracteres.');
	}

	return (object)["nome" => $nome, "telefone" => $telefone];
}



// retorna o índice da pessoa com o nome fornecido
function findByName($pessoas, $nome){
	$count = count($pessoas);

	foreach($pessoas as $i => $p){
		if($p->nome === $nome){
			return $i;
		}
	}

	return -1;
}



// GET -> retorna todas as pessoas ou uma pessoa com o nome fornecido
function doGet($pessoas){
	if(empty($_GET)){
		echo json_encode($pessoas);
	}
	else{
		$nome = $_GET['nome'];
		$index = findByName($pessoas, $nome);
		if($index < 0){
			echo 'Não encontrado';
		}
		else{
			echo json_encode($pessoas[$index]);
		}
	}
}



// POST -> adiciona uma pessoa ao array
function doPost($pessoas){
	checkParametros();

	$pessoa = pessoaToObject($_POST['nome'], $_POST['telefone']);
	array_push($pessoas, $pessoa);
	echo json_encode($pessoas);
}



// PUT - atualiza uma pessoa pelo nome
function doPut($pessoas){
	checkParametros();

	$_PUT = getData();

	$index = findByName($pessoas, $_GET['nome']);

	$pessoas[$index]->nome = $_PUT['nome'];
	$pessoas[$index]->telefone = $_PUT['telefone'];
	echo json_encode($pessoas);
}



// DELETE - deleta uma pessoa do array pelo nome
function doDelete($pessoas){
	$_DELETE = getData();

	$index = findByName($pessoas, $_GET['nome']);

	unset($pessoas[$index]);

	echo json_encode(array_values($pessoas));
}



// inicializa o array de pessoas
$pessoas = array();
array_push($pessoas, pessoaToObject('Bob', '22334455'));
array_push($pessoas, pessoaToObject('Suzan', '22445566'));
array_push($pessoas, pessoaToObject('Jack', '22556677'));

$method = mb_strtoupper($_SERVER['REQUEST_METHOD']);

switch($method){
	case 'GET': doGet($pessoas); break;
	case 'POST': doPost($pessoas); break;
	case 'PUT': doPut($pessoas); break;
	case 'DELETE': doDelete($pessoas); break;
}

?>
