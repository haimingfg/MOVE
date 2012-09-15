<?php
/**
 * 
 */

namespace MOVE\Operator;

use MOVE\Operator\IOperator;
use MOVE\Model\IModel;
abstract class OperatorBase implements IOperator{

	/**
	 * @inherits
	 */
	public function loadModel(IModel $modelName) {
		
	}
}
