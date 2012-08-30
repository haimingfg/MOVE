<?php
/**
 * This file is Http request param abstract class
 */
namespace MOVE\Operator\Network;
abstract class HttpRequestBase extends HttpRequestParams {
	
	protected static $pathSeperateStr = '/';

	public function getProtocol() {
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
		return $protocol.'://'.$host;
	}

	public function getHostUri(){
		return $this->getBaseHost() . $this->getInputFileBeforePath();
	}
	
	/**
	 * find input file the back of path
	 */
	public function getInputFileAfterPath(){
		$path = NULL;
		if ( NULL !== $this->getServer('PATH_INFO') ) {
			$path = $this->getServer('PATH_INFO');	
			//$path = preg_replace('/^\/+|\/+$/', '/', $path);
		} else {
			$path = $this->getInputFilePathInfo(true);
		}
		return $path;
	}

	public function getInputFileBeforePath(){
		return $this->getInputFilePathInfo(false);
	}

	private function getInputFilePathInfo($isAfter){
		$inputFile = $this->getRunScript();
		$path_arr = explode($inputFile, $this->getServer('REQUEST_URI'));
		
		$firPath = array_shift($path_arr);
		
		if ( 1 < count($path_arr) ) {
			$secPath = implode($inputFile, $path_arr);	
		} else {
			$secPath = NULL;
		}	

		$path = true === $isAfter ? $secPath : $firPath;
		
		$path = preg_replace('/^\/+|\/+$/', '/', $path);
		return $path;
	}
}
