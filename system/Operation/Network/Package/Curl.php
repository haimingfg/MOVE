<?php

namespace MOVE\Operation\Network\Package;

use MOVE\Operation\Network\RequestBase;

class Curl extends RequestBase {

	public function __construct($url) {
		parent::__construct($url);
		$this->_handler = curl_init();
	}
	
	protected function requestPrepare() {
		// set the curl_setopt
		// judge which method
		$url = $this->_url;
		if ( 'post' === $this->_method ) {
			isset ( $this->_params) && $this->_options[CURLOPT_POSTFIELDS] = http_build_query($this->_params);
			$this->_options[CURLOPT_POST] = 1;
		} else {
			isset( $this->_params ) && $url .= '?'. http_build_query($this->_params);
		}

		// set the url
		$this->_options[CURLOPT_URL] = $url;
		
		$__options = array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER	=> false,
				CURLOPT_PORT	=> isset($this->_port) ? $this->_port : 80 
				);

		$this->_options = $this->_options +  $__options;
		curl_setopt_array($this->_handler, $this->_options);
	}

	protected function request() {
		 return curl_exec($this->_handler);	
	}
}
