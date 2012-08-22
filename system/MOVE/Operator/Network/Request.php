<?php
/**
 * This file is deal network operation
 */
namespace MOVE\Operator\Network;

use MOVE\Operator\IOperator;
use MOVE\Helpers\Module;
use MOVE\Exception\OperatorException;
class Request Implements IOperator {

	public $url = NULL;

	public $method = NULL;

	public $port = NULL;

	public $param = NULL;

	private $__delegation = NULL;

	public function __construct($url, $method, $port, array $param = NULL){
		$this->url 	= $url;	
		$this->method 	= $method;
		$this->port 	= $port;
		$this->param 	= $param;

		if( true === Module::checkModuleSupport('curl') ) {
			$this->__delegation = new Package\Curl;	
		}else{
			throw new OperatorException('it\'s support curl module'); 
		}
	}

	public function execute(){
	
	}
}
