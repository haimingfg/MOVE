<?php
/**
 * This file is MOVE debug class
 */

namespace HM\Helpers;

class Debug
{
	public static $isWebApp = true;
	
	public static $isDebug = false;

	public static function getNewLineMark()
	{
		return true === self::$isWebApp ? "<br/>": "\r\n";	
	}

	public static function p()
	{
		$args = func_get_args();
		if ( true === self::$isWebApp ) {
			self::webDebug($args);
		} else {
		
		}
	}

	public static function webDebug($args)
	{
		static $colorShemes = array (
			'#E10057',
			'#4076DA'
		);
		static $i = 0;
		
		echo '<pre>';
		foreach ($args as $arg) {
			echo "<div style=\"color:{$colorShemes[$i]}\">";
			var_dump($arg);	
			echo "</div>";
			echo '<br>';
			$i++;
			if ( 0 == $i % 2 ) $i = 0;
		}
		echo '</pre>';
	}
}
