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

	public static $coreDir = 'MOVE';

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
			// whether is core directory
			$slashName_arr = explode(DIRECTORY_SEPARATOR, $fileAndClassName);
			
			$firSlashName = $slashName_arr[0];

			$fileAndClassNameWithExt = $fileAndClassName . '.' . self::$EXT;
			if ( self::$coreDir === $firSlashName ) {
				$filePath = self::$SYSPATH . '/' . $fileAndClassNameWithExt;
			} else {
				$filePath = self::$APPPATH . '/' . $fileAndClassNameWithExt;
			}
		

			if ( FALSE === self::loadFile($filePath) )
				throw new MOVEException('The :className class can\'t find in path :path', 
							array(
								'className'	=> $className,
								'path' 		=> $filePath
							));	
		} catch ( MOVEException $e ) {
			echo $e->getMessage();
			exit;
		}
	}
	
	/**
	 * require files 
	 * @param string $file
	 * return boolean;
	 */
	public static function loadFile($file){

		$file = realpath($file);
		if ( FALSE === $file ) return FALSE;
		
		if ( !in_array( $file, self::$__loadFiles) ) {
				array_push( self::$__loadFiles, $file );
				require $file;
		}

		return TRUE;
	}
}
