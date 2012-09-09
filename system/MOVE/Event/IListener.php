<?php

namespace MOVE\Event;

interface IListener {
	public static function start();

	public static function pause();

	public static function stop();
}
