<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{
	function _empty($name)
	{
		$this->display('Base:404');
	}

//	function _initialize()
//	{
//		$this->showTags();
//	}

	function showTags()
	{
		$tags = D('tags');
		$article = D('article')->where('is_delete = 0')->select();
		$tagsList = D('tags')->select();
		$tagArticle = array();
		foreach ($article as $item) {
			$item['tags'] = explode(',', $item['tags']);

		}
		$this->tagsList = $tags->select();
	}
}