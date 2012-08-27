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

	public $params = NULL;

	public $options = NULL;

	private $__delegation = NULL;

	public function __construct($url, $method, $port, array $params = NULL, array $options = NULL){
		$this->url 	= $url;	
		$this->method 	= $method;
		$this->port 	= $port;
		$this->params 	= $params;
		$this->options	= $options;

		if( true === Module::checkModuleSupport('curl') ) {
			$this->__delegation = new Package\Curl();	
		}else{
			throw new OperatorException('it\'s support curl module'); 
		}

		$this->runPrepare();
	}

	protected function runPrepare(){
		$this->__delegation->setParams($this->paramis);
		$this->__delegation->setOptions($this->options);	
		$this->__delegation->setSendMethod($this->method);
	}

	public function execute(){
	
	}
}
