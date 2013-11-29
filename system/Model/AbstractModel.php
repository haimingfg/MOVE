<?php

namespace HM\Model;
use HM\Operation as Operation;

/**
 * model抽象类
 */

abstract class AbstractModel implements IModel
{

	/**
	 * you should use BIGPLACE:FILENAME
	 * whether you use database or file or not
	 *
	 */
	protected $containerName = false;

	protected $linker = false;

	protected $moduleName = 'Database';

	public function __construct()
	{
		$this->initLinker();	
	}

	public function initLinker()
	{
		if (false === $this->linker) {
			$this->linker = Operation\Factory::Create($this->moduleName);		
			if (!empty($this->containerName)) {
				$split_arr = explode(':', $this->containerName);
				if (false !== $split_arr) {
					if (1 < count($split_arr)) {
						$this->linker->setDocumentName($split_arr[0]);
						$this->linker->setFileName($split_arr[1]);
					} else {
						$this->linker->setFileName($split_arr[0]);
					}
				}
			} else {
				$classNameSplit = explode('\\', get_class($this));	
				$className = array_pop($classNameSplit);
				$this->linker->setFilename(strtolower($className));		
			}
			$this->linker->init();
		} 
		return $this->linker;	
	}

	public function checkDataType()
	{

	}

	public function __call($method, $parameters)
	{
		if(method_exists($this->linker, $method)) {
		 return call_user_func_array(array($this->linker, $method), $parameters);
		}
	}
}
