<?php
/**
 * 
 */

namespace MOVE\Operation;

use MOVE\Operation\IOperation;
use MOVE\Model\IModel;
abstract class OperationBase implements IOperation{

	/**
	 * @inherits
	 */
	public function loadModel(IModel $modelName) {
		
	}
}
