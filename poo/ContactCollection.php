<?php

namespace cefet\php\poo;

interface ContactCollection {
	/**
	 * @throws CollectionException 
	 */
	public function create (Contact $contact);
}