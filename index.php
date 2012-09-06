<?php
use MOVE\MOVE;
use App\Event\HttpRequestEvent;
require 'system/MOVE.php';
spl_autoload_register('MOVE\MOVE::loadClass');
MOVE::$SYSPATH = __DIR__.'/system/';
MOVE::$APPPATH = __DIR__;
$ht = new HttpRequestEvent();
$ht->request('http://mnav.fetion.com.cn/mnav/getNetSystemconfig.aspx', 'post', 80, array());
var_dump($ht->response());
