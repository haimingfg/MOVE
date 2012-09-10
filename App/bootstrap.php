<?php
use MOVE\MOVE;
use MOVE\Event\Http\HttpRequestListener;
use MOVE\Helpers\Debug;
require_once __DIR__.'/../CoreBoot.php';
Debug::$isDebug = true;
MOVE::$APPPATH = realpath(__DIR__.'/../');

$routerRule = array(
	'ask-[\d]' => array('event'=>'ask', 'param'=>array('[\d]' => 1), 'directory'=>'abc')
);
HttpRequestListener::start($routerRule);
