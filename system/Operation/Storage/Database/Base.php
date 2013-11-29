<?php

namespace HM\Operation\Storage\Database;
use HM\Operation\Storage as Storage;
/**
 * Operator Database Abstract Method
 *
 * @author Haiming
 */
abstract class Base implements IDatabase
{
	protected $lastSql = null;
	
	protected $field = array();

	protected $where = array();

	protected $from = null;

	protected $orderBy = null;
	
	protected $groupBy = null;

	protected $config;

	protected $resource = false;

	protected $tableName = false;

	protected $dbName = false;

	protected $data = false;

	public function __construct($config)
	{
		$this->config = $config;
		$this->dbName = $this->config['dbname'];
	}

	public function init()
	{
		$this->connect();
	}

	public function __destruct()
	{
		if(false !== $this->resource) {
			//$this->close();
			$this->resource = false;
			Storage\ResourceSet::GetInstance()->del(get_class($this));
		}
	}

	public function setFileName($fileName)
	{
		$this->tableName = $fileName;
	}

	public function setDocumentName($documentName)
	{
		$this->config['dbname'] = $documentName;
		$this->dbName = $documentName;
	}

	public function handleField($_field)
	{
		// select `ab` as b,`io` b,
		$_a = explode(',', $_field);
		$_fieldArr = array();
		foreach ($_a as $__a) {
			if (preg_match('/^`.+`.*?$/i', $__a)) {
				$str = $__a;
			}elseif (preg_match('/([^`\s]+)\s+(as|\s+)?([^`\s]+)/i', $__a, $m)) {
				$str = "`{$m[1]}` AS {$m[3]}";
			} else {
				$str = "`{$__a}`";
			}
			array_push($_fieldArr, $str);
		}

		return implode(',', $_fieldArr);
	}

	public function handleWhere($_where)
	{
		$where = null;
		if (!is_array($_where)) {
			$where = preg_replace_callback('/([^\s\(]+)\s+?(in|=)\s+?(\(?[^\s|\(\)]+\)?)/i', 'handleStringWhere', $_where);
		} else {
			$_whereArr = array();
			foreach ($_where as $field => $value) {
				// filter field
				$field = $this->handleFieldOfWhere($field);
				
				if (is_array($value)) {
					$tmp = array();
					foreach ($value as $_value) {
						$tmp[] = $this->handleValue($_value);
						unset($_value);
					}
					unset($value);
					$value = $tmp;
					unset($tmp);
					$value = ' IN (\''.implode('\',\'', $value).'\')';
				} else {
					$value = ' = \''.$this->handleValue($value).'\'';
				}
				$_whereArr[] = implode('', array($field, $value));
			}
			$where = implode(' AND ', $_whereArr);
		}
		return $where;
	}

	public function handleStringWhere($matches)
	{
		$field = $matches[1];
		$operator = strtoupper($matches[2]);
		$value = $matches[3];
		//p($value);
		if ('IN' === $operator && preg_match('/\(([^\(\)]+)\)/', $value, $m)) {
			$valArr = array();
			foreach(explode(',', $m[1]) as $_value) {
				$valArr[] = $this->handleValue($_value);
				unset($_value);
			}
			unset($m, $value);
			$value = '(\''.implode('\',\'', $valArr).'\')';
		} else {
			$value = '\''.$this->handleValue($value).'\'';
		}
		// 进行
		return implode('', array($this->handleFieldOfWhere($field), ' ', $operator,' ', $value));
	}

	public function handleFieldOfWhere($_field)
	{
		if (preg_match('/`\w+`\./', $_field)) {
			$str = $_field;
		} elseif (preg_match('/([\w]+)\.([\w]+)/', $_field, $m)) {	
			$str = "`{$m[1]}`.{$m[2]}";
		} else {
			$str = "`{$_field}`";
		}
		return $str;
	}


	public function handleValue($value)
	{
		// clear front & end \'
		$value = trim($value, '\'');
		return $this->sensitiveFilter($value);	
	}

	public function field($_field)
	{
		array_push($this->field, $this->handleField($_field));
		return $this;	
	}

	public function where($_where)
	{
		array_push($this->where, $this->handleWhere($_where));
		return $this;
	}

	public function join()
	{
		return $this;
	}

	public function groupBy()
	{
		return $this;
	}

	public function orderBy()
	{
		return $this;
	}
	
	public function limit($limit)
	{
		if (is_array($limit)) {
			list($rowCount, $offset) = explode($limit);
			$rowCount = abs((int) $rowCount);
			$offset = abs((int) $offset);
			$this->limit = "LIMIT {$rowCount}, {$offset}";
		} else {
			$rowCount = abs((int) $limit);	
			$this->limit = "LIMIT {$rowCount}";
		}
		
		return $this;
	}

	public function select()
	{
		$where = is_array($this->where) && 0 < count($this->where) ? 
			implode('', $this->where) : '';
		$fields = is_array($this->field) && 0 < count($this->field) ? 
			implode(',', $this->field) : '*';
		$tableName = $this->getFullTableName();

		$sqlArray = array(
			'SELECT',
			$fields,
			'FROM',
			$tableName,
		);

		if (!empty($where)) array_push($sqlArray, 'WHERE '.$where);
		if (isset($this->groupBy)) array_push($sqlArray, $this->groupBy);
		if (isset($this->orderBy)) array_push($sqlArray, $this->orderBy);
		if (isset($this->limit)) array_push($sqlArray, $this->limit);

		unset(
			$this->where,
			$this->field,
			$this->groupBy,
			$this->limit,
			$this->orderBy
		);
		$this->where = $this->field = array();

		$result = $this->query(implode(' ', $sqlArray));
		return $result;
	}

	protected function getFullTableName()
	{
		return '`'.$this->dbName.'`.`'.$this->tableName.'`';
	}

	public function find($condition)
	{
		$this->where($condition)->limit(1);
		
		$result = $this->select();
		if (false !== $result) {
			return $result[0];
		}
		return false;
	}

	public function query($sql)
	{
		$sql .= ';';
		$this->lastSql = $sql;
		DEBUG($sql);
		return $this->_query($sql);
	}

	public function connect()
	{
		$name = get_class($this);
		$resourceObj = Storage\ResourceSet::GetInstance();
		if(false === $resourceObj->check($name)) {
		       	$this->_connect();
			$resourceObj->add($name, $this->resource);
		} else {
			$this->resource = $resourceObj->get($name);	
		}

		if (false === $this->resource) {
			// TODO
			DEBUG('Resource Error');
			exit;	
		}
	}

	protected function getTableFields()
	{
		static $_tableFieldsArray = false;

		if (false === $_tableFieldsArray) {
			$_tableFieldsArray = $this->_getTableFields();
			if (false === $_tableFieldsArray) {
				DEBUG('NO Table Field');
				exit;
			}
		}

		return $_tableFieldsArray;
	}

	abstract protected function _connect();

	abstract protected function _query($sql);

	abstract protected function sensitiveFilter($value);

	abstract protected function _getTableFields();

	public function data(array $data)
	{
		if (0 == count($data)) {
			return false;
		}

		$fields = $this->getTableFields();
		$filterValueForFields = array();
		$_datas = array();
		$_dataForKey = array();
		foreach ($data as $key => $_data) {
			if (is_array($_data)) {
				$_datas[] = $_data;	
			} else {
				$_dataForKey[$key] = $_data;	
			}
		}
		if(array() !== $_dataForKey) $_datas[] = $_dataForKey;

		foreach ($_datas as $index => $_data) {
			foreach ($fields as $field) {
				if(array_key_exists($field, $_data)) {
					$filterValueForFields[$index][$field] = $this->sensitiveFilter($_data[$field]); 
				}
			}	
		}
		$this->data = array() !== $filterValueForFields ? $filterValueForFields : false;	
		return $this;	
	}	

	public function insert()
	{
		DEBUG($this->data);
		if (!is_array($this->data)) return false;
		// insert into table value();
		$tableName = $this->getFullTableName();
		$effectiveFields = isset($this->data[0]) ? array_keys($this->data[0]): false;
		
		if (false === $effectiveFields) return false;

		$fieldsForInsert = implode('`,`', $effectiveFields);
		$valueForInsertArray = array();
		foreach ($this->data as $_data) {
			if (is_array($_data)) {
				$valueForInsertArray[] = '(\''.implode('\',\'', $_data).'\')'; 
			}
		}

		if (array() === $valueForInsertArray) return false;

		$valueForInsert = implode(',', $valueForInsertArray);
		$insertSql = "INSERT INTO {$tableName}(`{$fieldsForInsert}`) VALUES {$valueForInsert}";	
		DEBUG($insertSql);exit;
		$this->query($insertSql);
	}

	public function update()
	{
		DEBUG($this->data);
		if (!is_array($this->data)) return false;

		$tableName = $this->getFullTableName();
		
		if (!is_array($this->where) || 0 == count($this->where)) {
			// TODO
			DEBUG('WHERE is NULL,can\'t update');
			exit;	
		}

		$where = implode(' ', $this->where);

		$updateStrArray = array();
		foreach ($this->data as $data) {
			foreach ($data as $key => $val) {
				$updateStrArray[] = "`{$key}` = '{$val}'"; 
			}
			break;
		}

		if (array() === $updateStrArray) return false;	
		$updateStr = implode(',', $updateStrArray);

		$updateSql = "UPDATE {$tableName} SET {$updateStr} WHERE {$where}";
		//DEBUG($updateSql);exit;
		$this->query($updateSql);
	}
}
