<?php
/**
 *  MOVE base exception class
 *
 *  @author haiming
 */

namespace MOVE\Exception;

class MOVEException extends \Exception{

	public function __construct($message = null, array $params = null){
		if( isset( $message, $params ) ) {
			foreach ( $params as $key => $value ) {
				$message = str_replace(':'.$key, $value, $message);
			}
		}
		parent::__construct($message);
	}

	public static function catching(\Exception $exception){

		
	}

	public static function getTrace(){
		$debug_backtrace = debug_backtrace();	

		array_unshift($debug_backtrace);
		var_dump($debug_backtrace);	
	}
}
