<?php

namespace cefet\php\poo;

class ContactCollectionCSV implements ContactCollection {
	private $filename;

	public function __construct() {
		$this->filename = '../resources/contacts.csv';
	}

	// Override
	public function create(Contact $contact) {
		$errors = ContactValidation::validate($contact);

		if(count($errors) > 0) {
			throw new CollectionException(implode("\t", $errors));
		}

		file_put_contents($this->filename, PHP_EOL . $contact->toString(), FILE_APPEND);
	}


}