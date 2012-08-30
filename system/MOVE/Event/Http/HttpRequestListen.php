<?php
/**
 * Http listen event
 */

namespace MOVE\Event\Http;

use MOVE\Event\IListen;
use MOVE\Operator\Network\ClientHttpRequest;

class HttpRequestListen implements IListen {
	
	public static function start() {
		$chr = new ClientHttpRequest();
		echo '<pre>';
		var_dump($chr->getServer());
		$chr->getHostRequestUri();
	}

	public static function pause() {
		echo 'pause';
	}

	public static function stop() {
		echo 'stop';
	}
} 
