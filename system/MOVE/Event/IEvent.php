<?php
/**
 * This interface of event can 
 *
 */

namespace MOVE\Event;
use MOVE\Operator\IOperator;
interface IEvent {
	/**
	 * This function use to bind deal operation
	 *
	 */
	public function bind(IOperator $operator);

	
	/**
	 * This function use to run Event
	 */
	public function trigger();
}
