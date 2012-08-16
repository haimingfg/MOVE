<?php
/**
 * This file is loadClass that auto load class by namespace
 *
 * @author haiming
 *
 */
namespace MOVE;

use MOVE\Exception\MOVEException;

class MOVE {
	
	public static $EXT = 'php';
	
	public static $APPPATH = NULL;

	public static $SYSPATH = NULL;

	private static $__loadFiles = array();
	/**
	 * static auto load Class
	 * @param string $className
	 * @return null
	 */
	public static function loadClass($className){
		try {
			// TODO
			$fileAndClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);

			$fileAndClassNameWithExt = $fileAndClassName . '.' . self::$EXT;

			$realAppPath = realpath(self::$APPPATH . '/' . $fileAndClassNameWithExt);
			
			$loadFile = false;
			if ( FALSE !== $realAppPath ) {
				$loadFile = $realAppPath;
			} else {
			       	$realSysPath = realpath(self::$SYSPATH . '/' . $fileAndClassNameWithExt); 
				if ( FALSE !== $realSysPath ) $loadFile = $realSysPath;
			}

			if ( false === $loadFile ) 
				throw new MOVEException('The :className class can\'t find in path :path', 
								array(
									'className'	=> $className,
									'path' 		=> $fileAndClassNameWithExt
							));

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
				array_push( self::$__loadFiles, $file );
				require $file;
		}
	}
}
