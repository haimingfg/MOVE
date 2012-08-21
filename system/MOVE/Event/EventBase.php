<?php
/**
 * Abtract Event
 */
namespace MOVE\Event;

abstract class EventBase implements IEvent {

	protected $_bindOperator = null;

	public function bind( IOperator $operator ) {
		$this->_bindOperator = $operator; 
	}

	public function trigger(){
		return $this->_bindOperator->execute();	
	}
}
