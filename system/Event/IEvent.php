<?php
/**
 * This interface of event can 
 *
 */

namespace MOVE\Event;
use MOVE\Operation\IOperation;
interface IEvent {
	/**
	 * This function use to bind deal operation
	 *
	 */
	public function bind(IOperation $operator);

	
	/**
	 * This function use to run Event
	 */
	public function trigger();
}
