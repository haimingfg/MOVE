<?php
/**
 * deal with http request path and run the event
 */

namespace MOVE\Operation\Http;
use MOVE\Operation\Netrwork\IRouter;
use MOVE\Operation\IOperation;
class Router implements IRouter, IOperation{
	const FOUND = true;
	
	const NOFOUND = false;

	private static $__eventKey = 'event';

	private static $__paramKey   = 'param';

	private static $__directoryKey = 'directory';

	private static $__instance = null;
	
	private static array $__originRules = null;

	public static function init(){
		if ( is_null( self::$__instance ) ) {
			self::$__instance = new self();	
		}	
		return self::$__instance;
	}
	
	public function setRules( array $routerRules = null ){
		$this->filterRules($routerRules);
		\MOVE\Helpers\Debug::p(self::$__originRules);
		return $this;
	}

	public function filterRules( array $routerRules = null ) {
		if ( !is_null( $routerRules ) ) {
			foreach ( $routerRules as $rule => $params ) {
				if ( !isset ( $params[self::$__eventKey] ) && false === preg_match('/[^\d]/') ) continue;
				if ( isset ( $params[self::$__paramKey] ) && false === is_array($params[self::$__paramKey]) ) continue;
				if ( isset( $params[self::$__directoryKey]) && true === is_array($params[self::$__directoryKey])) continue;
				
				self::$__originRules[$rule] = $params;	
			}	
		}
	}

	public function analyze(){
		if ( !is_null ( self::$__originRules ) ) {
			$regularRules = array_keys(self::$__originRules);
			
			foreach ( $regularRules as $rule ) {
			}	
		}	

		return false;
	}


	public function execute(){
		$results = $this->analyze();
		$HttpResponse::init()->setEvent($results)->execute();
	}
}
