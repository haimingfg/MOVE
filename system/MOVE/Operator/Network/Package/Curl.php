<?php

namespace MOVE\Operator\Network\Package;

use MOVE\Operator\Network\IRequest;

class Curl implements IRequest{
	private $__handler = NULL;

	public function __construct() {
		$this->__handler = curl_init();
	}

	public function setParams() {
	
	}

	public function setOptions() {
	
	}	
}
