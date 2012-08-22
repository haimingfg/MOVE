<?php
/**
 * This Interface Io file
 */

namespace MOVE\Operator;

interface class IFileIo {

	public function read();

	public function open();

	public function delete();

	public function write();
}
