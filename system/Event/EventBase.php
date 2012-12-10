<?php
/**
 * Abstract Event
 */
namespace MOVE\Event;
use MOVE\Operation\IOPerator;
abstract class EventBase implements IEvent {

	protected $_bindOperation = null;

	public function bind( IOperation $operator ) {
		$this->_bindOperation = $operator; 
	}

	public function trigger(){
		return $this->_bindOperation->execute();	
	}
}
