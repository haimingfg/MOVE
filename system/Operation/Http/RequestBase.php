<?php
namespace MOVE\Operation\Http;
use MOVE\Helpers\Debug;
abstract class RequestBase {

	protected static $requestParams = array('GET', 'POST', 'COOKIE', 'SERVER', 'FILES');

	protected static $pathSeperateStr = '/';

	public function __construct() {
		$this->_GET = $_GET;
		$this->_POST = $_POST;
		$this->_COOKIE = $_COOKIE;
		$this->_SERVER = $_SERVER;
		$this->_FILES = $_FILES;
	}

	public function __call($name, $arguments) {
		if (in_array($name, static::$requestParams)){
			$internatParam = '_'.$name;
		       	return $this->$internatParam;	
		}
		return null;
	}

	public function __get($name) {
		$name = str_replace('_', '', $name);
		if (in_array($name, static::$requestParams)){
		       	return $this->$name;	
		}
		return null;
	}

	public function __set($name, $value) {
		$name = str_replace('_', '', $name);
		if (in_array($name, static::$requestParams)){
		       	$this->$name = $value;	
		}
	}

	public function getProtocol() {
		static $isHttps = null;
		if ( is_null($isHttps) )
			$isHttps = $this->SERVER('HTTPS');
		return isset($isHttps) ? 'https' : 'http' ;
	}

	public function getPort() {
		return $this->SERVER('SERVER_PORT');
	}

	public function getUserAgent() {
		return $this->SERVER('HTTP_USER_AGENT');
	}

	public function getHttpHost(){
		return $this->SERVER('HTTP_HOST');
	}

	public function getReferer(){
		return $this->SERVER('HTTP_REFERER');
	}

	public function getRunScript(){
		$originScript = $this->SERVER('SCRIPT_NAME');
		if ( false !== strpos($originScript, static::$pathSeperateStr) ) {
			// find last seperate lash
			$lastLashPos = strrpos($originScript, static::$pathSeperateStr);
			$scriptFile = substr($originScript, $lastLashPos + 1);
			return $scriptFile;	
		} else {
			return null;
		}
	}

	public function getBaseHost(){
		$protocol = $this->getProtocol();
		$host	= $this->getHttpHost();	
		$url =  $protocol.'://'.$host;
		return $url;
	}

	public function getHostUrl($needScript = false){
		$url = $this->getBaseHost() . $this->getInputFileBeforePath();
		if ( true === $needScript ) $url.= $this->getRunScript();
		return $url;
	}

	/**
	 * get request uri
	 * @param bool $needScript add runScript in this uri
	 * @return string
	 */
	public function getResponseUrl( $needScript = false ){
		$uri = $this->getHostUrl($needScript);
		$AfterPath = $this->getInputFileAfterPath();
		if ( false === $needScript ) $AfterPath = substr( $AfterPath, 1 );
		$uri .= $AfterPath;
		throw new \MOVE\Exception\OperationException('gh');
		return $uri;
	}
	
	/**
	 * find input file the back of path
	 */
	public function getInputFileAfterPath(){
		return 	$this->getInputFilePathInfo(true);
	}

	public function getInputFileBeforePath(){
		return $this->getInputFilePathInfo(false);
	}

	private function getInputFilePathInfo($isAfter){
		$inputFile = $this->getRunScript();
		$path_arr = explode($inputFile, $this->SERVER('REQUEST_URI'));
		$firPath = array_shift($path_arr);
		
		$path = null;	
		if ( false === $isAfter ) {
			$path = $firPath;
		} else {
			if ( 0 < count($path_arr) ) {
				$path = implode($inputFile, $path_arr);	
			
				$QMPos = strpos($path, '?');
				
				if( false !== $QMPos ) {
					$path = substr($path, 0, $QMPos);
				}
			}
		}	

		$path = '/' . $path . '/';
		$path = preg_replace('/^\/+|\/+$/', '/', $path);
		return $path;
	}
}
