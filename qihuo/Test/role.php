<?php
use QiHuo\Operation\Role as Role;
use HM\Operation\Storage as Storage;

require __DIR__.'/../Boots.php';

// 角色初始化
$role = Role\Factory::Create(1);
$role2 = Role\Factory::Create(2);
DEBUG(
	'我的名字:',
	$role->getName(),
	',我的职位:',
	$role->getPosition(),
	',我能够看',
	$role->getMenu()
);
DEBUG(
	'我的名字:',
	$role2->getName(),
	',我的职位:',
	$role2->getPosition(),
	',我能够看',
	$role2->getMenu()
);

//DEBUG(Storage\ResourceSet::GetInstance()->output());
