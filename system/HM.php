<?php

namespace HM;
use HM\Operation as Operation;
/**
 * This file is loadClass that auto load class by namespace
 *
 * @author haiming
 */
class HM 
{
	public static $EXT = 'php';
	
	public static $APPPATH = NULL;

	public static $SYSPATH = __DIR__;

	public static $coreDir = 'HM';

	public static $pattern = 'Web';

	/**
	 *
	 * @var array
	 * 
	 * it save file realpath
	 */
	private static $__loadFiles = array();

	
	/**
	 * I use the namespace to looking for the file path
	 * such as APP\Blog\Show it will transfer the path 
	 *
	 * @param String $className
	 * @return true
	 */
	public static function LoadClass($className)
       	{
		static $__loadClass = array();
		// if className hasn't '\', I think it don't use namespace so I just		     // return false 
		if (false === strpos($className, '\\')) return false;
		// if it loaded	
		if (in_array($className, $__loadClass)) return true;
		// first loaded, wether or not Loading
		array_push($__loadClass, $className);	
		$filePathStructure = explode('\\', $className);
		$fstFileName = array_shift($filePathStructure);

		$filePathArr = array();
		// Core Path
		if (self::$coreDir === $fstFileName) {
			array_push($filePathArr, self::$SYSPATH);	
		}
	        // Application Path	
		else {
			array_push($filePathArr, self::$APPPATH);
		}
		
		$classPath = implode('/', $filePathStructure);
		if ('' === $classPath) return false;

		array_push($filePathArr, $classPath);
		$filePath = implode('/', $filePathArr).'.'.self::$EXT;
		//var_dump($filePath.'<br/>');
		return self::LoadFile($filePath);	
	}


	/**
	 * require the file
	 * it have file cache, 
	 *
	 * @param String $filePath
	 * @return Boolean 
	 */
	public static function LoadFile($filePath)
	{
		$realFilePath = realpath($filePath);
		if (false !== $realFilePath && !isset(self::$__loadFiles[$realFilePath])) {
				$contents = require $realFilePath;		
				if (1 === $contents) {
					self::$__loadFiles[$realFilePath] = 1;		
					return true;
				} else {
					return $contents;	
				}
		}

		return false;
	}

	public static function HandleError()
	{

	}

	public static function HandleException()
	{
	
	}

	public static function init()
	{
		spl_autoload_register(array('self', 'LoadClass'));
		self::LoadFile(self::$SYSPATH.'/Helpers/function.php');
	}

	/**
	 * Load module path
	 */
	public static function SetModuleConfig(array $moduleConfig)
	{	
		if (!empty($moduleConfig)) {
			Operation\Factory::setConfig($moduleConfig);
		}
	}
}
