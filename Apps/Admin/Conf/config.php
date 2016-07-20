<?php
return array(
	//'配置项'=>'配置值'
	'TMPL_PARSE_STRING' => array(
		'__STATIC__' => __ROOT__ . '/Apps/Admin/View/static',
	),
	// 判断是否登录，哪些模块的哪些方法需要验证
	'DENY_SITUATION' => array(
		'Article' => array('dolist','update')
	),

);