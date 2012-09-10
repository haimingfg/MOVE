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
		$traces = $exception->getTrace();
		$traces = array_reverse($traces);
		$messages = $exception->getMessage();

		if ( true === Debug::$isDebug ) {
			$msg = array();
			$newLine = Debug::getNewLineMark();
			foreach ( $traces as  $trace ) {
				$caller = null;
				if ( isset($trace['class']) ) {
					$caller .= "Call {$trace['class']}{$trace['type']}{$trace['function']}";
				} else {
					$caller .= "Call {$trace['function']}";
				}
				$caller .= $newLine;
				$argTXT = var_export($trace['args'], true);
				if ( 1024 < strlen($argTXT) ) {
					$argTXT = substr($argTXT, 0, 1024) . '....';
				}
				$caller .= "the arguments is {$argTXT} {$newLine}";

				$caller .= "at {$trace['line']} line in {$trace['file']} {$newLine}";

				array_push($msg, $caller);
			}
			$messages .= $newLine . $newLine . ' The load file trace ' . $newLine . implode($newLine, $msg);
		}

		echo 'Untrace Exception: ' . $messages;
	}

	public static function argumentType($args) {
		
	}
}
