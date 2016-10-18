<?php

namespace cefet\php\poo;

/**
* Contact validation
*/
class ContactValidation
{
	/**
	 * Validates a contact objet
	 * @param  Contact $contact Contact instance to be validates
	 * @return array           Array with errors messages. Empty if object is valid.
	 */
	public static function validate(Contact $contact) {
		$errors = array();

		if(strlen($contact->getName()) < 2 || strlen($contact->getName()) > 100) {
			array_push($errors, "Contact name must have more than 2 characters and less than 100 characters");
		}

		if(!is_numeric($contact->getPhone())) {
			array_push($errors, "Contact phone must be a numeric value.");
		}

		if(strlen($contact->getPhone()) > 11) {
			array_push($errors, "Contact phone must not have more than 11 characters");
		}

		return $errors;
	}
}