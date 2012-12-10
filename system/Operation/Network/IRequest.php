<?php
namespace MOVE\Operation\Network;

use MOVE\Operation\IOperation;

interface IRequest extends IOperation{
	public function setParams(array $params = NULL);

	public function setOptions(array $options = NULL);

	public function setSendMethod($method);
}
