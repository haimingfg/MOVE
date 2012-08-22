<?php
/**
 * test event
 */
namespace App\Event;

use MOVE\Event\EventBase;
use MOVE\Operator\Network\Request;

class HttpRequestEvent extends EventBase {
	
	public function request($url, $method, $port, $param){	
		$this->bind(new Request($url, $method, $port, $param));		
	}
	
	public function response(){
		return $this->trigger();
	}
} 
