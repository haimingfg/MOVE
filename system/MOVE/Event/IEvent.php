<?php
/**
 * This interface of event can 
 *
 */

namespace MOVE/Event;

interface IEvent {
	
	public function notify();


	public function launchEvent();

}
