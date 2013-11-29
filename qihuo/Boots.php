<?php

use HM as Core;
/**
 * 期货
 */

require __DIR__.'/../system/HM.php';

Core\HM::$APPPATH = __DIR__;

// load data
Core\HM::init();

Core\HM::SetModuleConfig(
array(
	'Database' => array(
		'config' => __DIR__.'/config/mysql.php',
		'namespace' => 'HM\\Operation\\Storage\\Database',
		'drive' => 'mysql'
	),
	'FileSystem' => '',
	'Cache' => '',
)
);
