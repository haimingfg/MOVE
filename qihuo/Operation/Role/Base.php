<?php

namespace QiHuo\Operation\Role;
use QiHuo\Model as Model;

class Base
{
	private $name; 

	private $menu = array();

	private $position;


	public function getMenu()
	{
		return $this->menu;	
	}

	public function setMenu($menuIdStr)
	{
		static $mMenu = false;
		if (empty($menuIdStr)) {
			return false;
		}
		
		$menuIdArray = explode(':', $menuIdStr);
		
		if (1 < count($menuIdArray)) sort($menuIdArray);
		
		if (false === $mMenu) {
			$mMenu = new Model\Menu();
		}

		$where = array('id' => $menuIdArray);
		$menus = $mMenu->where($where)->select();
		if (false === $menus) return false;
		
		foreach ($menus as $menu) {
			$this->menu[$menu['id']] = $menu['name'];
		}
		return true;
	}

	public function getPosition()
	{
		return $this->position;	
	}

	public function setPosition($position)
	{
		$this->position = $position;	
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
}
