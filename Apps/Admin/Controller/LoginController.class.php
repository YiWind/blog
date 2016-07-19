<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class LoginController extends CommonController
{
	public function index()
	{
		if (session('islogin')) {
			$this->redirect('Article/dolist');
		} else {
			$issubmit = I('get.issubmit');
			$UserModel = D("User");
			if ($issubmit) {
				$verify = new \Think\Verify();
				if (!$verify->check(trim(I('post.verify')))) {
					$this->error("验证码错误", 'index');
				}
				$data['email'] = trim(I('post.email'));
				$data['password'] = md5(sha1(trim(I('post.password'))));
				$user = $UserModel->where($data)->find();
				if ($user) {
					// 保存登录session
					session('islogin', true);
					$this->redirect('Article/dolist');
				} else {
					$this->error('用户名或密码错误', 'index');
				}
			}
		}
		$this->display();
	}

	public function logout()
	{
		session("islogin", null);
		$this->redirect("Login/index");
	}

	public function verify()
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


}