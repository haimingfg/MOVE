<?php
/**
 * test event
 */
namespace App\Event;

use MOVE\Event\EventBase;
use MOVE\Operator\Network;

class HttpRequestEvent extends EventBase {
	
	public function request($url, $method, $port, $param){	
		$this->bind(new Network($url, $method, $port, $param));		
	}
	
	public function response(){
		return $this->trigger();
	}
} 
