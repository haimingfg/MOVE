<?php
namespace MOVE\Operator\Network;

use MOVE\Operator\IOperator;

interface IRequest extends IOperator{
	public function setParams(array $params = NULL);

	public function setOptions(array $options = NULL);

	public function setSendMethod($method);
}
