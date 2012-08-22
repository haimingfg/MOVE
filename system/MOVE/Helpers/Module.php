<?php
/**
 * moduel class in helper
 *
 */
namespace MOVE\Helpers;
class Module {
	/**
	 * @param string $moduelName
	 * @return boolean
	 */
	public static function checkModuleSupport($moduelName){
		return	isset($moduelName) && in_array($moduelName, get_loaded_extensions());
	}
}
