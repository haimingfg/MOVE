<?php
/**
 * this is the interface of router 
 *
 */
namespace MOVE\Operator\Network;

use MOVE\Operator\IOperator;

interface IRouter implements IOperator {
	
	protected function analyze();	
}
