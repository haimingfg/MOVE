<?php

namespace MOVE\Event;

interface IListen {
	public static function start();

	public static function pause();

	public static function stop();
}
