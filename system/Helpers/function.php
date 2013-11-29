<?php

/**
 * debug function
 */
use HM AS Core;
use HM\Helpers;

if (! function_exists('DEBUG')) :
	function DEBUG()
	{
		Helpers\Debug::WebDebug(func_get_args());	
	}
endif;

if (! function_exists('require_cache')) :
	function require_cache($path)
	{
		return Core\HM::LoadFile($path);
	}
endif;
