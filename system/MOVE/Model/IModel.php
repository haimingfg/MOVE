<?php
/**
 * This interface is model
 * @author haiming
 */

namespace MOVE/Model;


interface IModel {

	/**
	 * This function is check the dataType
	 * @param string $dataType;
	 * @param mixed $value;
	 *
	 * @return boolean
	 */
	public function checkData($dataType, $value);
	
	/**
	 * This function is check model all atttibutes
	 * @return boolean 
	 */
	public function checkAllData();
}
