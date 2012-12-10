<?php
/**
 * Http listen event
 */

namespace MOVE\Event\Http;

use MOVE\Event\IListener;
use MOVE\Operator\Network\HttpRouter;
use MOVE\Exception\EventException;

class HttpRequestListener implements IListener {
	
	public static function start( array $routerRules = null ) {
		$isSuccess = HttpRouter::init()->setRules($routerRules)->execute();	
		if (  $isSuccess === HttpRouter::FOUND ) {

		} elseif ( $isSuccess === HttpRouter::NOTFOUND ) {
			self::pause();
		} else {
			self::stop();
		}
	}

	public static function pause() {
		return HttpRouter::init()->displayPage(404);	
	}

	public static function stop() {
		throw new EventException('stop');
	}
} 
