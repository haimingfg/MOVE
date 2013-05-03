<?php

namespace HM\Operation\Storage\Database;
use HM\Operation\Storage\Drives;
use HM\Helpers\Configure;

/**
 * Database Factory, create mysql etc;
 *
 * @author Haiming
 */
class DatabaseFactory
{
	private $config;

	public function create($databaseType)
	{
		$databaseObj = null;
		if (isset($this->config->namespace)) {
			$className = $this->config->namespace.'//'.$this->config->databaseType;	
			$databaseObj = new $className($this->config);
		} elseif (isset($databaseType)) {
			$databaseObj = new Drives\$databaseType($this->config);
		} else {
			throw new HMDBException('Nothing Database Type Is Assigned!');
		}
		return $databaseObj;
	}

	
	public function setConfig(DbConfig $config)
	{
		$this->config = $config;
	}
}
