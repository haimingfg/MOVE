<?php

namespace HM\Operation;

/**
 * Operation Factory
 *
 * @author Haiming
 */
class Factory 
{
	private static $config;

	public static function Create($moduleName)
	{
		if (isset(self::$config[$moduleName])) {
			$moduleConfig = self::$config[$moduleName];

			$namespace = isset($moduleConfig['namespace']) ? $moduleConfig['namespace'] :'';		
			$config = false;
			$configPath = isset($moduleConfig['config']) ? $moduleConfig['config'] : '';

			if (!empty($configPath)) {
				$config = \HM\HM::LoadFile($configPath);	
			}	

			$drive = isset($moduleConfig['drive']) ? ucfirst($moduleConfig['drive']) :  '';
			$className = $namespace.'\\Drives\\'.$drive;
			//DEBUG($className);
			return new $className($config);
		} else {
			//TODO some system exception
			DEBUG('There isn\'t module config');
		}
	}

	
	public static function setConfig($config)
	{
		self::$config = $config;
	}
}
