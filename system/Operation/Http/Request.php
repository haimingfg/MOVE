<?php
/**
 * This is file get the $_GET, $_POST, $_FILES param
 */

namespace MOVE\Operation\Http;

class Request extends RequestBase{	

	private static $__instance = null;

	public static function instance(){
		if( is_null(self::$__instance) ) {
			self::$__instance = new self();
		}
		
		return self::$__instance;
	}

	public function __construct(){
		parent::__construct();
	}

}
