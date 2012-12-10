<?php
/**
 *
 */
namespace MOVE\Operation\Network;
abstract class RequestBase implements IRequest {
	protected $_handler = NULL;

	protected $_params = NULL;

	protected $_options = NULL;

	protected $_url	= NULL;

	protected $_port = NULL;

	protected function __construct($url){
		$this->_url = $url;
	}
	public function setParams( array $params = NULL ) {
		if ( false === self::isEmpty($params) ) {
			$this->_params = $params;	
		}
	}

	public function setOptions( array $options = NULL ) {
		if ( false === self::isEmpty($options) ) {
			$this->_options = $options;
		}
	}

	public function setSendMethod($method){
		false === self::isEmpty($method) && $this->_method = $method;
	}

	public function setPort($port){
		false === self::isEmpty($port) && $this->_port = $port;
	}

	private static function isEmpty($values){
		return empty( $values ) ? true : false;
	}

	abstract protected function requestPrepare();

	abstract protected function request();

	public function execute(){
		$this->requestPrepare();
		return $this->request();
	}
}
