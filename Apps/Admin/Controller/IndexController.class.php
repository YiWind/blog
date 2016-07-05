<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends CommonController {
	public function index() {
		$this -> display();
	}
}