<?php
/**
 * This is file get the $_GET, $_POST, $_FILES param
 */

namespace MOVE\Operation\Http;

class Request extends RequestBase{	

	public static function init() {
		static $instance = null;
		if (is_null($instance)) $instance = new self();
	       	return $instance;	
	}

	public function __construct(){
		parent::__construct();
	}

}
