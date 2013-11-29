<?php

use QiHuo\Model as Model;
require __DIR__.'/../Boots.php';

/**
 * test update
 */

$role = new Model\Role();

$data[] = array(
	'name' => "2'--",
	'position' => $position,
	'menu' => 3
);

$role->data($data)->where(array('id' => 1))->update();
