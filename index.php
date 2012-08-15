<?php
require 'system/MOVE.php';
spl_autoload_register(array('\MOVE\MOVE','loadClass'));

MOVE::$SYSPATH = __DIR__.'/system/';
// load not exist class
$event = new Event();
