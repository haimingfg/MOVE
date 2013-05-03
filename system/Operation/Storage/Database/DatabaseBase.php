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

	public function where($_where)
	{
		$this->where = array_push($this->where, $this->handleWhere($_where));
		return $this;
	}

	protected function handleWhere($_where)
	{
		if (!is_array($_where)) {
				
		} else {
			$_whereArr = array();
			foreach ($_where as $field => $value) {
				if (is_array($value)) {
					$_whereArr[] = implode('', array($field, ' IN (\'', implode('\',\'', $value), '\')');
				} else {
					$_whereArr[] = implode('', array($field, ' = \'', $value, '\''));
				}
			}
		}
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
