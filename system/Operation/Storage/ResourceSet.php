<?php

namespace HM\Operation\Storage;
/**
 * It's for resource information
 *
 * @author Haiming
 */

class ResourceSet
{
	private static $_instance = false;

	private $_resourceSet = array();

	public function __construct()
	{
		//self::GetInstance();
	}

	public static function GetInstance()
	{
		if (false === self::$_instance) {
			self::$_instance = new self();
		}
		return  self::$_instance;
	}

	public function del($name)
	{
		unset($this->_resourceSet[$name]);	
	}

	public function add($name, $resource)
	{
		unset($this->_resourceSet[$name]);
		$this->_resourceSet[$name] = & $resource;
		return true;
	}

	public function get($name) 
	{
		if ($this->check($name)) {
			return $this->_resourceSet[$name];
		}	
		return false;
	}

	public function check($name)
	{
		return isset($this->_resourceSet[$name]);
	}


	public function output()
	{
		return $this->_resourceSet;
	}
}
