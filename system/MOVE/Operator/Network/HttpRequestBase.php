<?php
/**
 * This file is Http request param abstract class
 */

namespace MOVE\Operator\Network;

abstract class HttpRequestBase {
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
		unset($_GET, $_POST, $_SERVER, $_FILES);
	}

	public function __call( $name, $arguments ){
		$getType = substr($name, 0, 3);
		if ( 'get' === $getType ) {
			$method = NULL;
			// getGet
			$dataType = substr($name, 2);
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
			}

			if ( false === empty( $arguments[0] ) ) {
				return isset($methods[$arguments[0]]) ? $methods[$arguments[0]]: NULL;
			} else {
				return $methods;
			}
			
		} else {
			return null;
		}
	}
	
	public function getProtocol() {
		return isset($this->getServer('HTTPS') ? 'https' : 'http' ;
	}

	public function getPort() {
		return $this->getServer('SERVER_PORT');
	}

	public function getUserAgent() {
		return $this->getServer('HTTP_USER_AGENT');
	}
}
