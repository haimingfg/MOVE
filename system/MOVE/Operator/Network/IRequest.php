<?php
namespace MOVE\Operator\Network;
interface IRequest{
	public function setParams(array $params = NULL);

	public function setOptions(array $options = NULL);

	public function setSendMethod($method);
}
