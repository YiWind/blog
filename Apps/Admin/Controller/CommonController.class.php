<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{
	public function isLogin()
	{
		$isLogin = session('islogin');
		if (!$isLogin) {
			$this->redirect('Login/index');
			return;
		} else {
			session('islogin', $isLogin);
		}
	}

	public function _empty($name)
	{
		$str = '没有找到' . $name . '页面';
		$this->show('error 404! ' . $str);
	}
}