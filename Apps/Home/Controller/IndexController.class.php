<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;

class IndexController extends CommonController
{
	public function index()
	{
		$article = D('Article');
		$parser = new \Org\Util\Parser();
		$count = $article->where('is_delete = 0')->count();
		$page = new \Think\Page($count, 10);
		$page->lastSuffix = false;// 不加这行不会显示末页
		$page->setConfig('header', '共 %TOTAL_ROW% 条记录');
		$page->setConfig('prev', '上一页');
		$page->setConfig('next', '下一页');
		$page->setConfig('first', '首页');
		$page->setConfig('last', '末页');
		$page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$pageInfo = $page->show();
		$dataList = $article->where('is_delete = 0')->order('create_time desc')->limit($page->firstRow . ',' . $page->listRows)->select();
		$this->dataList = $dataList;
		$this->pageInfo = $pageInfo;
		$this->display();
	}

	function detail()
	{
		$id = I('get.id');
		$article = D('Article');
		$result = $article->where('id=' . $id)->find();
		if ($result) {
			$this->article = $result;
		} else {
			$this->display('Base:404');
			exit();
		}
		// 上一页，下一页
		$pre['id'] = array('lt', $id);
		$next['id'] = array('gt', $id);
		$preArticle = $article->where($pre)->limit('1')->find();
		$nextArticle = $article->where($next)->limit('1')->find();
		$this->preArticle = $preArticle;
		$this->nextArticle = $nextArticle;
		$this->display();
	}
}