<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends CommonController
{
	public function index()
	{
		echo __FILE__;
		$this->display();
	}
}