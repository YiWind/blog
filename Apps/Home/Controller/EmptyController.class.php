<?php
namespace Home\Controller;

use Think\Controller;

class EmptyController extends Controller
{
	public function _empty($name)
	{
		// **CONTROLLER_NAME**当前控制器名
		$this->show("当前调用的是空控制器：" . CONTROLLER_NAME . "控制器。使用的是：" . $name . "方法。");
	}
}