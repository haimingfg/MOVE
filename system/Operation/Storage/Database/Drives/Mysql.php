<?php

namespace HM\Operation\Storage\Database\Drives;
use HM\Operation\Storage\Database as Base;
/**
 * Database Drives Mysql
 *
 * @author Haiming
 */

class Mysql extends Base\Base
{
	public function _connect()
	{	
		DEBUG(1);
		$config = $this->config;
		$this->resource = @new \mysqli(
			$config['host'], $config['user'],
			$config['password'], $config['dbname'],
			$config['port']
		);
		if ($this->resource->connect_errno) {
			DEBUG($this->resource->connect_error, $this->resource->connect_errno);
			exit;
		}

		$this->resource->set_charset($config['charset']);
	}

	public function close()
	{
		$this->resource->close();
	} 

	public function changeDB($dbname = false)
	{
		if (false !== $dbname)
			$this->resource->select_db($dbname);
	}

	public function _query($sql)
	{
		$result = $this->resource->query($sql);
		if (false === $result) {
			//TODO
			DEBUG($this->resource->error);
			exit;
		}

		if (true !== $result) {
			$rows = array();	
			while($row = $result->fetch_assoc()){
				$rows[] = $row;	
			}
			$result->free();
			return array() !== $rows ? $rows : false;
		}
		return true;
	}

	protected function sensitiveFilter($value)
	{
		if (function_exists('magic_quotes_gpc')) {
			if (magic_quotes_gpc()) {
				stripslashes($value);	
			}
		}	
		return $this->resource->real_escape_string($value);
	}


	public function _getTableFields()
	{
		$tableFields = $this->query('SHOW COLUMNS FROM '.$this->getFullTableName());
		$fields = array();
		if (false !== $tableFields) {
			foreach ($tableFields as $field) {
				$fields[] = $field['Field'];	
			}	
		}
		return array() !== $fields ? $fields: false;
	}
}
