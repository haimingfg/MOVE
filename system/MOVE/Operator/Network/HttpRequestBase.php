<?php
/**
 * This file is Http request param abstract class
 */
namespace MOVE\Operator\Network;
abstract class HttpRequestBase {
	protected $hrp = NULL;

	public function __construct(){
		$this->hrp = new HttpRequestParams();
	}
	
	public function getProtocol() {
		$isHttps = $this->hrp->getServer('HTTPS');
		return isset($isHttps) ? 'https' : 'http' ;
	}

	public function getPort() {
		return $this->hrp->getServer('SERVER_PORT');
	}

	public function getUserAgent() {
		return $this->hrp->getServer('HTTP_USER_AGENT');
	}

	public function getHttpHost(){
		return $this->hrp->getServer('HTTP_HOST');
	}

	public function getReferer(){
		return $this->hrp->getServer('HTTP_REFERER');
	}
	
	public function getRequestUri(){
		return $this->hrp->getServer('REQUEST_URI');
	}

	public function getBaseHost(){
		$protocol = $this->getProtocol();
		$host	= $this->getHttpHost();
		return $protocol.'://'.$host;
	}
}
