<?php

require_once("../poo/Utils.php");
require_once("../poo/Contact.php");
require_once("../poo/ContactValidation.php");
require_once("../poo/ContactCollection.php");
require_once("../poo/ContactCollectionCSV.php");
require_once("../poo/CollectionException.php");

use cefet\php\poo\Utils;
use cefet\php\poo\Contact;
use cefet\php\poo\ContactValidation;
use cefet\php\poo\ContactCollection;
use cefet\php\poo\CollectionException;
use cefet\php\poo\ContactCollectionCSV;

header("Content-Type: application/json");

function doGet() {

}

function doPost() {

	$request = Utils::getRequest();
	$contact = new Contact($request["name"], $request["phone"], $request["email"]);

	/* exercise 1 
	var_dump($contact); */

	/* exercise 2
	$errors = ContactValidation::validate($contact);

	if(count($errors) > 0) {
		header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');
		echo json_encode($errors);
		die();
	}

	header($_SERVER["SERVER_PROTOCOL"] . ' 200 Success');
	*/
	try {
		$contactCollection = new ContactCollectionCSV();
		$contactCollection->create($contact);
		header($_SERVER["SERVER_PROTOCOL"] . ' 200 Success');
	} catch (CollectionException $e) {
		header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');		
		echo json_encode(json_encode(explode("\t", $e->getMessage())));
	}
}

switch(strtoupper($_SERVER["REQUEST_METHOD"])) {
	case 'GET': doGet(); break;
	case 'POST': doPost(); break;
	default: 
		header($_SERVER["SERVER_PROTOCOL"] .  ' 400 Bad Request');
		die('Invalid method');
}
