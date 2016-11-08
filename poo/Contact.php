<?php

namespace cefet\php\poo;

/**
* Contact representation
*/
class Contact {
	private $name;
	private $phone;
	private $email;

	function __construct($name, $phone, $email) {
		$this->name = $name;
		$this->phone = $phone;
		$this->email = $email;
	}
 
	/**
	* Gets the value of name.
	*
	* @return mixed
	*/
	public function getName() {
	    return $this->name;
	}
 
	/**
	* Sets the value of name.
	*
	* @param mixed $name the name
	*
	* @return self
	*/
	public function setName($name) {
	    $this->name = $name;
	}
 
	/**
	* Gets the value of phone.
	*
	* @return mixed
	*/
	public function getPhone() {
	    return $this->phone;
	}
 
	/**
	* Sets the value of phone.
	*
	* @param mixed $phone the phone
	*
	* @return self
	*/
	public function setPhone($phone) {
	    $this->phone = $phone;
	}
 
	/**
	* Gets the value of email.
	*
	* @return mixed
	*/
	public function getEmail() {
	    return $this->email;
	}
 
	/**
	* Sets the value of email.
	*
	* @param mixed $email the email
	*
	* @return self
	*/
	public function setEmail($email) {
	    $this->email = $email;
	}

	public function toString() {
		return $this->getName() . 
			"," . $this->getPhone() .
			"," . $this->getEmail();

	}
}