<?php
namespace Admin\Controller;

use Think\Controller;

class IndexController extends CommonController
{
	public function index()
	{
		$this->redirect("Login/index");
	}
}