<?php
/**
 * Http listen event
 */

namespace MOVE\Event\Http;

use MOVE\Event\IListener;
use MOVE\Operator\Network\ClientHttpRequest;
use MOVE\Exception\EventException;
class HttpRequestListener implements IListener {
	
	public static function start() {
		$chr = new ClientHttpRequest();
		\MOVE\Helpers\Debug::p(1,$chr->getResponseUrl(true), array(1,2,3,4));
	}

	public static function pause() {
		throw new EventException('pause');
	}

	public static function stop() {
		throw new EventException('stop');
	}
} 
