<?php
/**
 * project boot file
 *
 * @author haiming
 */
use MOVE as Core;
use MOVE\Helpers\Debug;

// input core boot file ,This file have assign MOVE class to load 
// class through namespace
require __DIR__.'/../coreboot.php';

// open heplers debug
Debug::$isDebug = true;
// assign Application path
Core\MOVE::$APPPATH = realpath(__DIR__.'/../');

/**
 *
 *
 */
$routerRule = array(
	'ask-[\d]' => array('event'=>'ask', 'param'=>array('[\d]' => 1), 'directory'=>'abc')
);
Debug::p($routerRule);
