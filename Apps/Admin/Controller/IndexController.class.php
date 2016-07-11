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
		$id = I('get.id');
		$isDelete = I('get.delete');
		$isSubmit = I('get.submit');
		$Article = D('Article');
		if ($isDelete && $id) {
			// 删除
			$data['id'] = $id;
			$data['is_delete'] = $isDelete;
			$Article->where("id = " . $id)->create($data);
			$Article->save();
			$this->redirect('Index/index');
		}
		if ($id) {
			// 编辑
			$Article->where("id = " . $id)->find();
			$this->assign('article', $Article);
		}
		$this->display();
	}
}