<?php
/**
 *  MOVE base exception class
 *
 *  @author haiming
 */

namespace MOVE\Exception;
use MOVE\Helpers\Debug;
class MOVEException extends \Exception{

	public function __construct($message = null, array $params = null){
		if( isset( $message, $params ) ) {
			foreach ( $params as $key => $value ) {
				$message = str_replace(':'.$key, $value, $message);
			}
		}
		parent::__construct($message);
	}
	
	public static function handle(MOVEException $exception){
		$traces = array();

		do {
			$msg = '';
		} while ( $e = $exception->getPrevious() ) ;
	}
}
