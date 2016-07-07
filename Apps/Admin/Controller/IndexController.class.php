<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends CommonController
{
	public function index()
	{
		$Articel = D('Article');
		$dataList = array();
		for ($i = 0; $i < 3; $i++) {
			$dataList[$i]['title'] = $i;
		}
		$Articel->create($Articel);
		$Articel->addAll();
//		echo '<pre>';
//		var_dump($dataList);
//		echo '</pre>';
		exit;
		$list = $Articel->where("is_delete = 0")->select();
		$this->assign('list', $list);

		$this->display();
	}
}