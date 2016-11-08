<?php

header("Content-Type: application/json");

// retorna um array com os dados do request
function getData(){
	$body = file_get_contents('php://input');
	$array = array();
	mb_parse_str($body, $array);

	return $array;
}



function checkParameters(){
	$data = getData();
	if (!isset($data['name'])) {
		header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		die('Name not sent.');
	}

	if (!isset($data['phone'])) {
		header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		die('Phone note sent.');
	}
}



// retorna um objeto pessoa
function contactToObject($name, $phone){

	// validação
	$tamname = mb_strlen($name);

	if ($tamname < 2 || $tamname > 60) {
		//header($_SERVER['SERVER_PROTOCOL'].'400 Bad Request');
		header('HTTP/1.1 400 Bad Request');
		die('Name length must be longer than 2 characters and lower then 60 characters.');
	}

	return (object)['name' => $name, 'phone' => $phone];
}



// retorna o índice da pessoa com o name fornecido
function findByName($people, $name){
	$count = count($people);

	foreach($people as $i => $p){
		if($p->name === $name){
			return $i;
		}
	}

	return -1;
}



// GET -> retorna todas as people ou uma pessoa com o name fornecido
function doGet($people){
	if(empty($_GET)){
		echo json_encode($people);
	}
	else{
		$name = $_GET['name'];
		$index = findByName($people, $name);
		if($index < 0){
			echo 'Contact not found';
		}
		else{
			echo json_encode($people[$index]);
		}
	}
}



// POST -> adiciona uma pessoa ao array
function doPost($people){
	checkParameters();

	$pessoa = contactToObject($_POST['name'], $_POST['phone']);
	array_push($people, $pessoa);
	echo json_encode($people);
}



// PUT - atualiza uma pessoa pelo name
function doPut($people){
	checkParameters();

	$_PUT = getData();

	$index = findByName($people, $_GET['name']);

	$people[$index]->name = $_PUT['name'];
	$people[$index]->phone = $_PUT['phone'];
	echo json_encode($people);
}



// DELETE - deleta uma pessoa do array pelo name
function doDelete($people){
	$_DELETE = getData();

	$index = findByName($people, $_GET['name']);

	unset($people[$index]);

	echo json_encode(array_values($people));
}



// inicializa o array de people
$people = array();
array_push($people, contactToObject('Bob', '22334455'));
array_push($people, contactToObject('Suzan', '22445566'));
array_push($people, contactToObject('Jack', '22556677'));

$method = mb_strtoupper($_SERVER['REQUEST_METHOD']);

switch($method){
	case 'GET': doGet($people); break;
	case 'POST': doPost($people); break;
	case 'PUT': doPut($people); break;
	case 'DELETE': doDelete($people); break;
}

?>
