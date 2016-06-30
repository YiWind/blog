<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
	public function _empty($name)
	{
		$str = '没有找到' . $name . '页面';
		$this->show('error 404! ' . $str);
	}
}