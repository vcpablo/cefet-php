<?php

/**
 * 1. Crie um scrit para CLI que imprima o caminho e o tamanho, em KB (KiloBytes), de todos os arquivos PHP no diretório atual
 */

$d = DIRECTORY_SEPARATOR;
$dir = "C:{$d}Apache24{$d}htdocs{$d}cefet{$d}php{$d}server{$d}";

$argv = $_SERVER["argv"];

/*$pattern = (isset($argv[1])) ? $argv[1] : '*.php';

foreach (glob($dir . $pattern) as $arquivo) {
	$pathinfo = pathinfo($arquivo);
	 if(isset($pathinfo["extension"]) && strtolower($pathinfo["extension"]) == "php") {
		echo "Caminho completo: " .realpath($arquivo) . PHP_EOL . "Tamanho: " . filesize($arquivo)/1024 . " bytes" . PHP_EOL . "-----------------------" . PHP_EOL . PHP_EOL;
	 }
}*/

/**
 * 3. Faça um script que leia um arquivo e imprima quantas vogais há nesse arquivo
 */

$path = $argv[1];

if(!isset($path)) {
	die("Informe o caminho completo de um arquivo valido (texto).");
}

if(!file_exists($path)) {
	die("Arquivo nao encontrado: " . $path);
}

$file = fopen($path, "r");

/*

$count = 0;

while(!feof($file)) {
	$char = fgetc($file);
	switch(strtolower($char)) {
		case "a":
		case "b":
		case "c":
		case "d":
		case "e":
			$count++;
		break;
	}
}

echo "$count vogais encontradas";

fclose($file);*/


/**
 * 4. Faça um script que leia um arquivo PHP e informe quantos comandos há nele.
 */

// $lineNumber = 1;
while(!feof($file)) {
	$line = fgets($file);
	
	foreach ($line as $word) {
		echo $word . PHP_EOL . "-------" . PHP_EOL . PHP_EOL;
		if(is_callable($word)) {
			echo "Comando: " . $word . PHP_EOL . "-------" . PHP_EOL . PHP_EOL;
		}
	}


	// echo "Line $lineNumber : " . str_word_count($line) . " words". PHP_EOL . "-----" . PHP_EOL . PHP_EOL;
	// $lineNumber++;
}