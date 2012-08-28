<?php
/**
 * Http listen event
 */

namespace MOVE\Event\Http;

use MOVE\Event\IListen;
use MOVE\Operator\Network\ClientHttpRequest;

class HttpRequestListen implements IListen {
	
	public static function start() {
		
	}

	public static function pause() {
		echo 'pause';
	}

	public static function stop() {
		echo 'stop';
	}
} 
