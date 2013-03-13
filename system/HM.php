<?php
/**
 * This file is loadClass that auto load class by namespace
 *
 * @author haiming
 */
namespace HM;

use HM\Exception\HMException;

class HM {
	
	public static $EXT = 'php';
	
	public static $APPPATH = NULL;

	public static $SYSPATH = __DIR__;

	public static $coreDir = 'HM';

	private static $__loadFiles = array();

	/**
	 * static auto load Class
	 * @param string $className
	 * @return null
	 */
	public static function loadClass($className){
		try {
			$fileAndClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
			// whether is core directory
			$slashName_arr = explode(DIRECTORY_SEPARATOR, $fileAndClassName);
			
			$firSlashName = $slashName_arr[0];

			$fileAndClassNameWithExt = $fileAndClassName . '.' . self::$EXT;
			if ( self::$coreDir === $firSlashName ) {
				$fileAndClassNameWithExt = str_replace('HM/', '', $fileAndClassNameWithExt);
				$filePath = self::$SYSPATH . '/' . $fileAndClassNameWithExt;
			} else {
				$filePath = self::$APPPATH . '/' . $fileAndClassNameWithExt;
			}
			
			if ( FALSE === self::loadFile($filePath) )
				throw new HMException('The :className class can\'t find in path :path', 
							array(
								'className'	=> $className,
								'path' 		=> $filePath
							));	
		} catch ( HMException $e ) {
			echo $e->getMessage();
			exit;
		}
	}
	
	/**
	 * require files 
	 * @param string $file
	 * return string;
	 */
	public static function loadFile($file){
		$file = realpath($file);
		if ( FALSE === $file ) return FALSE;
		
		if ( !in_array( $file, self::$__loadFiles ) ) {
				array_push( self::$__loadFiles, $file );
				require $file;
		}
		return $file;
	}

	public static function regLoad(){
		spl_autoload_register(array('self', 'loadClass'));	
	}

	public static function regErrorHandler(){
	}

	public static function regExceptionHandler(){
		set_exception_handler(array('HM\Exception\HMException','handle'));
	}

	public static function initialize(){
		self::regLoad();
		self::regExceptionHandler();
		self::regErrorHandler();
	}
}
