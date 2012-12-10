<?php
/**
 * This is Cache interface
 */

namespace MOVE\Operation;

interface ICache {
	
	public function set( $key, $value, $time = 0);

	public function get( $key );

	public function delete( $key );
	
	public function replace ( $key, $value, $time = 0);
}
