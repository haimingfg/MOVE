<?php
/**
 * This file is loadClass that auto load class by namespace
 *
 * @author haiming
 *
 */
namespace MOVE;

use MOVE\Exception;

class MOVE {
	
	public static $EXT = 'php';
	
	public static $APPPATH = NULL;

	public static $SYSPATH = NULL;

	private static $__loadFiles = NULL;
	/**
	 * static auto load Class
	 * @param string $className
	 * @return null
	 */
	public static function loadClass($className){
		try {
			// TODO
			$fileAndClassName = $className;

			$fileAndClassNameWithExt = $fileAndClassName . '.' . self::$EXT;

			$realAppPath = realpath(self::$APPPATH . '/' . $fileAndClassNameWithExt);
			var_dump(self::$SYSPATH); var_dump($fileAndClassNameWithExt);	
			$loadFile = false;
			if ( FALSE !== $realAppPath ) {
				$loadFile = $realAppPath;
			} else {
			       	$realSysPath = realpath(self::$SYSPATH . '/' . $fileAndClassNameWithExt); 
				if ( FALSE !== $realSysPath ) $loadFile = $realSysPath;
			}
			
			if ( false === $loadFile )throw new MOVEException('this file can\'t find');

			self::loadFile($loadFile);
		
		} catch ( MOVEException $e ) {
			echo $e->getMessage();
			exit;
		}
	}
	
	/**
	 * require files 
	 * @param string $file
	 * @return null
	 */
	public static function loadFile($file){
		if ( !in_array( $file, self::$__loadFiles) ) {
				array_push($file, self::$__loadFiles);
				require $file;
		}
	}
}
