<?php
namespace Admin\Controller;

use Think\Controller;

class CommonController extends Controller
{

	function _empty($name)
	{
		$this->display('Base/404');
	}

	function verifyCode()
	{
		// 实例化verify对象
		$verify = new \Think\Verify();
		$verify->fontSize = 14;
		$verify->length = 4;
		$verify->imageH = 40;
		$verify->useImgBg = true;
		$verify->useNoise = false;
		$verify->entry();
	}

	/**
	 * 未登录跳转至登录界面
	 */
	function isLogin()
	{
		if (!session('USER_AUTH_KEY')) {
			$this->redirect('Login/index');
		}
	}

	/**
	 * 判断是否登录，哪些模块需要验证
	 */
	function _initialize()
	{
		if (array_key_exists(CONTROLLER_NAME, C('DENY_SITUATION'))) {
			$denyAction = C('DENY_SITUATION')[CONTROLLER_NAME];
			if (in_array(ACTION_NAME, $denyAction)) {
				$this->isLogin();
			}
		}
	}
}