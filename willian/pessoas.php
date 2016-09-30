<?php
$file = "./pessoas.csv";

$content = file_get_contents($file);

$linhas = explode(PHP_EOL, $content);

$pessoas = [];

foreach($linhas as $l){
	$p = explode(',', $l);
	$pessoas []= array(
		'id' => $l[0],
		'nome' => $l[1],
		'idade' => $l[2]
	);
}

foreach($pessoas as $p){
	echo 'Id: ', $p['id'], ', Nome: ', $p['nome'], ', Idade: ', $p['idade'], PHP_EOL;
}
?>