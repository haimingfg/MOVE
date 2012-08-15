<?php
/**
 * This interface is model
<<<<<<< HEAD
 * It can check the dataType of attributes ,is it right?
 * but this class is not connect db or api, the function of connection 
 * do by operator
=======
>>>>>>> 27c7d5831e647760e1cbf8707f35d36d3bccae03
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
