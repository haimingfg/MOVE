<?php
use MOVE\Exception\MOVEException;
use MOVE\MOVE;
require_once __DIR__.'/system/MOVE.php';
MOVE::initialize();

throw new MOVEException('Fuck :name', array('name'=>'haiming li'));
