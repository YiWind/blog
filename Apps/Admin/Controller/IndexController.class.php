<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends CommonController
{
	public function index()
	{	
		$say = "<h1>Hello World!I'm Admin!</h1>";
		$this->show($say);
	}
}