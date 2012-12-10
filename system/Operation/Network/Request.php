<?php
/**
 * This file is deal network operation
 */
namespace MOVE\Operation\Network;

use MOVE\Operation\IOperation;
use MOVE\Helpers\Module;
use MOVE\Exception\OperationException;
class Request Implements IOperation {

	private $__delegation = NULL;

	public function __construct($url, $method, $port, array $params = NULL, array $options = NULL){

		if( true === Module::checkModuleSupport('curl') ) {
			$this->__delegation = new Package\Curl($url);	
		}else{
			throw new OperationException('it\'s support curl module'); 
		}

		$this->runPrepare($params, $options, $method, $port);
	}

	protected function runPrepare($params, $options, $method, $port){
		$this->__delegation->setParams($params);
		$this->__delegation->setOptions($options);	
		$this->__delegation->setSendMethod($method);
		$this->__delegation->setPort($port);
	}

	public function execute(){
		return $this->__delegation->execute();	
	}
}
