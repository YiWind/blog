<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class LoginController extends CommonController
{

	function index()
	{
		$issubmit = I('get.issubmit');
		if ($issubmit) {
			$verify = new \Think\Verify();
			if (!$verify->check(trim(I('post.code')))) {
				$this->error('验证码错误。', 'index');
			}
			$UserModel = D('User');
			$data['email'] = trim(I('post.email'));
			$data['is_delete'] = 0;
			// 获取密码并加密
			$pwd = md5(sha1(trim(I('post.password'))));
			$authinfo = $UserModel->where($data)->find();
			if ($authinfo && $authinfo['email'] === $data['email']) {
				if ($pwd !== $authinfo['password']) {
					$this->error('密码错误!', 'index');
				}
			} else {
				$this->error('用户名不存在!', 'index');
			}
			// 可以登录保存登录session
			session('USER_AUTH_KEY', $authinfo);
			$this->redirect('Article/dolist');
		}

		$this->display();
	}

	function logout()
	{
		session('USER_AUTH_KEY', null);
		$this->redirect('Login/index');
	}

}