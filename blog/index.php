<?php

use HM AS Core; 
use \Blog;

require __DIR__.'/../system/HM.php';

Core\HM::$APPPATH = __DIR__;

Core\HM::init();

Core\HM::LoadFile(Core\HM::$SYSPATH.'/Helpers/function.php');
//$a = new Blog\App();
//
//require_cache(__DIR__.'/acticle.php');
//$b = new acticle(); 
//
//p($a, $b);
/* ------------------------------------------ Test Field ----------------------- */
//$_field = '`b`,bw,fa ag,`g f  as b,  cffasf as ma, v AS b, t s,`as` as tr';
//$_a = explode(',', $_field);
//p($_a);
//$_fieldArr = array();
//foreach ($_a as $__a) {
//	$__a = trim($__a);
//	if (preg_match('/^`.+`.*?$/i', $__a)) {
//		p(1);
//		$str = $__a;
//	}elseif (preg_match('/^([^`\s]+)\s+(as\s+)?([^`\s]+)$/i', $__a, $m)) {
//		$str = "`{$m[1]}` AS {$m[3]}";
//		p(2);
//	} elseif(preg_match('/^([^`\s]+)\s+([^`\s]+)$/i', $__a, $m)) {
//		p(3 );
//		$str = "`{$m[1]}` AS {$m[2]}";
//	} else {
//		p(4);
//		$str = "`{$__a}`";
//	}
//	p($str, $__a);
//	array_push($_fieldArr, $str);
//}
//p(implode(',', $_fieldArr));

/* ------------------------------ Test Where --------------------- */

function handleWhere($_where)
{
	$where = null;
	if (!is_array($_where)) {
		$where = preg_replace('/([^\s]+)\.?\s+=\s+([^\s+])/Ui', '`$1` = $2', $_where);
	} else {
		$_whereArr = array();
		foreach ($_where as $field => $value) {
			if (is_array($value)) {
				$_whereArr[] = implode('', array('`', $field, '`', ' IN (\'', implode('\',\'', $value), '\')'));
			} else {
				$_whereArr[] = implode('', array('`', $field, '`', ' = \'', $value, '\''));
			}
		}
		$where = implode(' AND ', $_whereArr);
	}

	return $where;
}

// Test Where Array
$str = array('a' => 1, 'b' => array(12,5));
p(handleWhere($str));

// Test Where String
$str = 'a = 1 AND ad.ac = 1 or b in (1)';
p(handleWhere($str));
