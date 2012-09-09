<?php
/**
 * This file is Http request param abstract class
 */
namespace MOVE\Operator\Network;
abstract class HttpRequestBase extends HttpRequestParams {
	
	protected static $pathSeperateStr = '/';
	
	public function __construct(){
		parent::__construct();
	}

	public function getProtocol() {
		static $isHttps = null;
		if ( is_null($isHttps) )
			$isHttps = $this->getServer('HTTPS');
		return isset($isHttps) ? 'https' : 'http' ;
	}

	public function getPort() {
		return $this->getServer('SERVER_PORT');
	}

	public function getUserAgent() {
		return $this->getServer('HTTP_USER_AGENT');
	}

	public function getHttpHost(){
		return $this->getServer('HTTP_HOST');
	}

	public function getReferer(){
		return $this->getServer('HTTP_REFERER');
	}

	public function getRunScript(){
		$originScript = $this->getServer('SCRIPT_NAME');
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
		$path_arr = explode($inputFile, $this->getServer('REQUEST_URI'));
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
