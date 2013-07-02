<?php

namespace HM\Operation\Database;

/**
 * Operator Database Abstract Method
 *
 * @author Haiming
 */
abstract DatabaseBase implements IDatabase
{
	protected $sql;
	
	protected $field = null;

	protected $from = null;

	protected $orderBy = null;
	
	protected $groupBy = null;

	protected $orderBy = null;

	public function field($_field)
	{
		$this->field = array_push($this->field, $this->handleField($_field));
		return $this;	
	}

	protected function handleField($_field)
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

	function handleWhere($_where)
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

	function handleStringWhere($matches)
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

	function handleFieldOfWhere($_field)
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


	function handleValue($value)
	{
		// clear front & end \'
		$value = trim($value, '\'');
		return $value;	
	}

	public function where($_where)
	{
		$this->where = array_push($this->where, $this->handleWhere($_where));
		return $this;
	}

	public function from()
	{
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
	
	public function limit()
	{
	
	}

	public function select()
	{
	}

	public function find()
	{
	}
}
