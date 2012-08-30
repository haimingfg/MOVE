<?php
use MOVE\MOVE;
use MOVE\Event\Http\HttpRequestListen;

require_once __DIR__.'/../CoreBoot.php';

MOVE::$APPPATH = __DIR__;

HttpRequestListen::start();
