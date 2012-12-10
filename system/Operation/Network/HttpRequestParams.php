<?php

namespace MOVE\Operator\Network;
use MOVE\Exception\EventException;
class HttpRequestParams {
	protected $_Get = NULL;

	protected $_Post = NULL;
	
	protected $_Cookie = NULL;

	protected $_Server = NULL;

	protected $_Files = NULL;

	public function __construct(){
		$this->_Get = $_GET;
		$this->_Post = $_POST;
		$this->_Cookie = $_COOKIE;
		$this->_Server = $_SERVER;
		$this->_Files = $_FILES;
	//	unset($_GET, $_POST, $_SERVER, $_FILES);
	}

	public function __call( $name, $arguments ){
		$getType = substr($name, 0, 3);
		if ( 'get' === $getType ) {

			$method = NULL;
			// getGet
			$dataType = substr($name, 3);
			if ( 'Get' ===  $dataType ) {
				$methods = $this->_Get;
			} elseif ( 'Post' === $dataType ) {
				$methods = $this->_Post;
			} elseif ( 'Cookie' === $dataType ) {
				$methods = $this->_Cookie;
			} elseif ( 'Server' === $dataType ) {
				$methods = $this->_Server;
			} elseif ( 'Files' === $dataType ) {
				$methods = $this->_FILES;
			} else {
				throw new EventException('can');	
			}
			if ( isset( $arguments[0] ) ) {
				return isset( $methods[$arguments[0]] ) ? $methods[$arguments[0]] : NULL;
			} else {
				return $methods;
			}	
		}
	
	}
}
