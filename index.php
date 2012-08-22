<?php
use MOVE\MOVE;
use App\Event\HttpRequestEvent;
require 'system/MOVE.php';
spl_autoload_register('MOVE\MOVE::loadClass');
MOVE::$SYSPATH = __DIR__.'/system/';
MOVE::$APPPATH = __DIR__;
// load not exist 
$event = new HttpRequestEvent();

$event->request($url, $port, $method, $param);
var_dump($event->response());
