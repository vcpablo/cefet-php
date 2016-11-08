
<?php
/**
* 1) Considere o arquivo CSV abaixo:

------------------------------------
"Ana", "ana@servidor.com", "123muda"
"Bia", "bia@provedor.com", "bix456"
"Carla", "carla@site.com", "c4rl4!"
------------------------------------

Esse arquivo, usuarios.csv, tem a lista de usuários do sistema. Uma solicitação GET para um arquivo usuarios.php deve ler o arquivo e retornar, como JSON, apenas o primeiro e o segundo dado desse arquivo, que dizem respeito ao nome e o e-mail dos usuários. Um POST para usuarios.php deve permitir acrescentar um usuário ao fim do arquivo, caso seja válido - isto é, ter: a) Nome com 2 a 60 caracteres; b) ser um e-mail que contenha "@" após o primeiro caractere; c) senha, de 6 a 100 caracteres. Se não for válido, uma resposta de código 400 deve ser retornada, com um array em formato JSON, com as mensagens relativas aos erros identificados.

Dica: Use as funções file_get_contetns e file_put_contents para obter ou gravar em usuarios.csv.
*/


 header("Content-type: application/json");

$method = $_SERVER["REQUEST_METHOD"];


 function getRequest() {
 	$body = file_get_contents('php://input');
	$array = array();
	mb_parse_str($body, $array);

	return $array;
 }


function validate($data) {
	
	$errors = array();

	if (!isset($data['email']) || (isset($data['email']) && strlen($data['email']) == 0)) {
		array_push($errors, "Email is required");
	} else if(mb_strpos($data['email'], '@', 1) === false) {
		array_push($errors, "Invalid e-mail. Ex.: p@email.com");
	}

	if (!isset($data['password']) || (isset($data['password']) && strlen($data['password']) == 0)) {
		array_push($errors, "Password is required");
	} else if( !( strlen($data['password']) > 2 && strlen($data['password']) < 60 ) ) {
		array_push($errors, "Password length must have between 6 and 100 characters.");
	}


	if(count($errors) > 0) {
		header($_SERVER['SERVER_PROTOCOL'] . '400 Bad Request');
		die(json_encode($errors));
	}

	return true;
}

function doGet()  {

	echo json_encode($users);
}

function doPost()  {
	$filename = '../resources/users.csv' ;
	$data = getRequest();

	if(validate($data)) {

		$filename = file_get_contents( '../resources/users.csv' );
		$rows = explode(PHP_EOL, $filename);

		foreach($rows as $row) {
			$user = explode(",", $row);


			if($data['email'] == $user[1] && $data['password'] == $user[2]) {
				header('HTTP/1.1 200 Success');		
				die(json_encode("Login successfull"));
				
			}
			
			header('HTTP/1.1 400 Bad Request');
			echo json_encode(["Invalid credentials"]);
			exit;
		}

		
	}



	// if(validate($data)) {
	// 	$userStr = $data['name'] . "," . $data['email'] . "," . $data['password'];
	// 	file_put_contents($filename, PHP_EOL . $userStr, FILE_APPEND);
	// 	echo true;
	// }
}

switch(strtoupper($method)) {
	case 'POST': doPost(); break;
	default: 
		die('Invalid method');
}
