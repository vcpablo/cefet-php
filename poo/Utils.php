<?php

namespace cefet\php\poo;

/**
* Métodos utilitários
*/
class Utils
{
	
	public static function getRequest() {
		$body = file_get_contents('php://input');
		$array = array();
		mb_parse_str($body, $array);

		return $array;
	}
}