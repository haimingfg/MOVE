<?php

namespace HM\Operation\Storage\Database;

/**
 * The Database Interface
 *
 */
interface IDatabase
{
	public function connect();

	public function changeDatabase();

	public function query();

	public function close();
}

