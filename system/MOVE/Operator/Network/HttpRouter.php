<?php
/**
 * deal with http request path and run the event
 */

namespace MOVE\Operator\Network;

class HttpRouter implements IRouter{
	const FOUND = true;
	
	const NOFOUND = false;
	
	private static $__instance = null;
	
	private static $__originRules = null;

	public static function init(){
		if ( is_null( self::$__instance ) ) {
			self::$__instance = new self();	
		}	
		return self::$__instance;
	}
	
	public function setRules( array $routerRules = null ){
		self::$__originRules = $this->filterOption($routerRules);
	}

	protected function analyze (){
		if ( 1) {
		
		}	
	}


	public function execute(){
		$results = $this->analyze();
		$HttpResponse::init()->setEvent($results)->execute();
	}
}
