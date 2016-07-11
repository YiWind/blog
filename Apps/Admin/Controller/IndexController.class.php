<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends CommonController
{
	public function index()
	{
		$Articel = D('Article');
		$list = $Articel->where("is_delete = 0")->select();
		$this->assign('list', $list);

		$this->display();
	}

	public function update()
	{
		$this->display();
	}
}