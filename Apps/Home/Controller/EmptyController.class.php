<?php
namespace Home\Controller;

use Think\Controller;

class EmptyController extends Controller
{
	public function _empty($name)
	{
		//
		$this->show("no Controller: " . CONTROLLER_NAME . " and used function: " . $name);
	}
}