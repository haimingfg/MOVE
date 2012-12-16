<?php

namespace MOVE\Operation\Http;
use MOVE\Operation\Exception;

/**
 * 
 *
 */
class RequestParams {
	protected $_GET = null;

	protected $_POST = null;
	
	protected $_COOKIE = null;

	protected $_SERVER = null;

	protected $_FILES = null;

	public function __construct(){
		$this->_GET = $_GET;
		$this->_POST = $_POST;
		$this->_COOKIE = $_COOKIE;
		$this->_Server = $_SERVER;
		$this->_FILES = $_FILES;
	//	unset($_GET, $_POST, $_SERVER, $_FILES);
	}

	public function __call( $name, $arguments ){
		$name = strtoupper($name);
		
		if (false === isset($this->$name)) throw new Exception('the request of type is not defined');	

		$params = $this->$name;
		$argument = $arguments[0];
		if(isset($argument)) {
			return isset($params[$argument]) ? $params[$argument] : null;
		} else {
			return $params;
		}
	}
}
