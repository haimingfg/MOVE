<?php
/**
 * project boot file
 *
 * @author haiming
 */
use MOVE as Core;
use MOVE\Helpers as Helpers;

// input core boot file ,This file have assign MOVE class to load 
// class through namespace
require __DIR__.'/../coreboot.php';

// open heplers debug
Helpers\Debug::$isDebug = true;

// assign Application path
Core\MOVE::$APPPATH = realpath(__DIR__.'/../');

/**
 *
 *
 */
$routerRule = array(
	'ask-[\d]' => array('event'=>'ask', 'param'=>array('[\d]' => 1), 'directory'=>'abc')
);
