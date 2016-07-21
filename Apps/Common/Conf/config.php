<?php
return array(
	"URL_MODEL" => 2,
//	'TMPL_l_DELIM' => '<{', //修改左定界符
//	'TMPL_R_DELIM' => '}>', //修改右定界符
	"SESSION_AUTO_START" => true,
//	'TMPL_STRIP_SPACE' => true, // 是否去除模板文件里面的html空格与换行
	'SHOW_PAGE_TRACE' => true,
	'URL_CASE_INSENSITIVE' => true, // url大小写不敏感
	'URL_HTML_SUFFIX' => 'html|shtml|php',
	// 'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg', // URL禁止访问的后缀设置
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '127.0.0.1', // 服务器地址
	'DB_NAME' => 'test', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => '123456', // 密码
	'DB_PORT' => 3306, // 端口
	'DB_PREFIX' => 'blog_', // 数据库表前缀
	'DB_CHARSET' => 'utf8', // 字符集
	'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
	'MODULE_ALLOW_LIST' => array('Home', 'Admin'), // 定义允许访问的木块
	'DEFAULT_MODULE' => 'Home', // 当访问的模块不存在时，路由到默认模块下的控制器中，因为这个模块中有空方法或者空控制器，所以就起到了空模块的作用
);
