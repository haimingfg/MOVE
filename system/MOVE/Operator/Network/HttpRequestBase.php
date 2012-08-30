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
	
	public function getRequestUri(){
		$originRequestUri = $this->getServer('REQUEST_URI');
		if ( isset($originRequestUri) ) {
			
		} else {
			return static::$pathSeperateStr;
		}
	}

	public function getRunScript(){
		$originScript = $this->getserver('SCRIPT_NAME');
		
		if ( false !== strpos($originScript, static::$pathSeperateStr) ) {
			
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
		$requestUri = $this->getRequestUri();
	}

	public function pathInfo(){
		
	}
}
