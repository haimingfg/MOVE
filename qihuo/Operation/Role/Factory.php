<?php

namespace QiHuo\Operation\Role;
use QiHuo\Model\Role;

/**
 * 角色工厂
 */


class Factory
{
	public static function Create($roleId)
	{
		$roleData = self::_initRole($roleId);

		$className = __NAMESPACE__.'\Base';	
		$roleObj = new $className();
		$roleObj->setName($roleData['name']);
		$roleObj->setPosition($roleData['position']);
		$roleObj->setMenu($roleData['menu']);

		return $roleObj;
	}

	private static function _initRole($roleId)
	{
		static $mRole = false;
		if (false === $mRole) {
			$mRole = new Role();
		}	
		return $mRole->find(
			array('id' => $roleId,
			'is_deprecated' => 0)
		);
	}
}
