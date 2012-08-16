<?php
require 'system/MOVE.php';
\MOVE\MOVE::$SYSPATH = __DIR__.'/system/';
\MOVE\MOVE::$APPPATH = __DIR__.'/app/';
spl_autoload_register(array('\MOVE\MOVE','loadClass'));
// load not exist class
$event = new MOVE\Event\IEvent();
