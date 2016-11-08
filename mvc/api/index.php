<?php

header("Content-Type: application/json");

$games = array(
	(object)array("id" => 1, "nome" => "Assassin's Creed Chronicles", "lancamento" => "India, 12/01/2016"),
	(object)array("id" => 2, "nome" => "Dark Souls 3", "lancamento" => "12/04/2016"),
	(object)array("id" => 3, "nome" => "Final Fantasy 10", "lancamento" => "12/05/2016"),
	(object)array("id" => 4, "nome" => "Firewatch", "lancamento" => "21/09/2016"),
	(object)array("id" => 5, "nome" => "Overwatch", "lancamento" => "24/05/2016"),
	(object)array("id" => 6, "nome" => "Raise of the Tomb Raider", "lancamento" => "11/10/2016"),
	(object)array("id" => 7, "nome" => "Mortal Kombat XL", "lancamento" => "01/03/2016")
);


function isEmpty($var){   return $var !== ""; }

function getUrlPieces($url){   
	return array_values(array_filter(explode("/", $url), "isEmpty")); 
}

function getRequest() {
	$body = file_get_contents('php://input');
	$array = array();
	mb_parse_str($body, $array);

	return $array;
}

function doGet($games) {
	echo json_encode($games);
}

function doDelete($pieces) {
	header('HTTP/1.1 200 OK');
	echo json_encode("Game # " . $pieces['1'] . " removido com sucesso");
}



$url = $_SERVER['REQUEST_URI'];
$pattern = "/\/(games)(\/[0-9]+)?$/";
$matches = [];

$match = preg_match($pattern, $url, $matches);
$method = strtoupper($_SERVER["REQUEST_METHOD"]);



if($match === 1) {
	$pieces = getUrlPieces($matches[0]);

	switch($method) {     
		case 'GET':
			doGet($games); 
			break;     
		case 'DELETE':
			doDelete($pieces); 
			break;   
	} 
}