<?php
/**
 * This file is Interface View
 * the View obj can communicate with Operation to active event
 * and listen  model to launch event
 *
 */

namespace MOVE\View

interface IView {

	
	/**
	 * listen model launch event
	 */

	public function listen();

	/**
	 * connect Operation
	 * @return mixed
	 */
	public function connectOperation(IOperation $operator);


	/**
	 * it can launchEvent
	 * @param IEvent $event
	 * @reutrn mixed
	 */

	public function launchEvent(IEvent $event);
}
