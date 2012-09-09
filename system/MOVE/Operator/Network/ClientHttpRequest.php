<?php
/**
 * This is file get the $_GET, $_POST, $_FILES param
 */

namespace MOVE\Operator\Network;

class ClientHttpRequest extends HttpRequestBase{	

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
