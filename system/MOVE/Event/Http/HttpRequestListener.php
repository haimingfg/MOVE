<?php
/**
 * Http listen event
 */

namespace MOVE\Event\Http;

use MOVE\Event\IListener;
use MOVE\Operator\Network\ClientHttpRequest;

class HttpRequestListener implements IListener {
	
	public static function start() {
		$chr = new ClientHttpRequest();
		\MOVE\Helpers\Debug::p(1,$chr->getResponseUrl(true), array(1,2,3,4));
	}

	public static function pause() {
		echo 'pause';
	}

	public static function stop() {
		echo 'stop';
	}
} 
