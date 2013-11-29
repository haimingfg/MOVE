<?php

use QiHuo\Model as Model;
require __DIR__.'/../Boots.php';
//Test insert

$role = new Model\Role();

$data[] = array(
	'name' => "2'--",
	'position' => $position,
	'menu' => 3
);
$data[] = array(
	'name' => 2,
	'position' => $position,
	'menu' => 3
);

$role->data($data)->insert();
