<?php
/**
 * This is Operator Interface
 *
 */
namespace MOVE\Operator;

use MOVE\Model\IModel;

interface IOperator{

	/**
	 * load model content
	 * @param string $modelName
	 * @return null
	 */
	public function loadModel(IModel $modelName);

	/**
	 * load Sub Operator
	 *
	 */
	public function loadSubOperator();
	
	/**
	 * load and show View
	 *
	 */
	public function vectorView();
	
}
