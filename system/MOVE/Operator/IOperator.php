<?php
/**
 * This is Operator Interface
 *
 */
namespace MOVE/Operator;

interface IOperator{

	/**
	 * load model content
	 * @param string $modelName
	 * @return null
	 */
	public function loadModel($modelName);
	
	/**
	 * load and show View
	 *
	 */
	public function vectorView();
	
}
