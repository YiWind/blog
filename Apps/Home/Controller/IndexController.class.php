<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends CommonController
{
	public function index()
	{
		$Article = D("Article");
		$xx = $Article->where("id=1")->find();
		$summary = $xx['summary'];
		$this->assign("summary", $summary);
		$this->display();
	}
}