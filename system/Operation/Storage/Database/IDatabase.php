<?php

namespace HM\Operation\Storage\Database;

/**
 * The Database Interface
 *
 */
interface IDatabase
{
	public function connect();

	public function changeDB($dbname = false);

	public function query($sql);

	public function close();
}

