<?php
namespace Admin\Controller;

use Think\Controller;

class ArticleController extends CommonController
{
	public function __construct()
	{
		$this->assign("article", 1);
	}

	public function dolist()
	{
		parent::isLogin();
		$this->assign("article", 1);
		$ArticleModel = D("Article");
		$articleList = $ArticleModel->where("is_delete = 0")->select();
		$this->assign('articleList', $articleList);
		$this->display("list");
	}

	public function category()
	{
		parent::isLogin();
		$this->show("category");
	}
}
