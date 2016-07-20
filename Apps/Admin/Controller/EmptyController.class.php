<?php
namespace Admin\Controller;

use Think\Controller;

class EmptyController extends Controller
{
	public function _empty($name)
	{
		// **MODULE_NAME**当前模块名
		// **CONTROLLER_NAME**当前控制器名
		// **ACTION_NAME**当前方法名
//		$this->show("当前调用的是空控制器：" . CONTROLLER_NAME . "控制器。使用的是：" . $name . "方法。");
		$this->display("Base/404");
	}
}