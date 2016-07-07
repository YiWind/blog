<?php
return array(
	"URL_MODEL" => 2,
	"SESSION_AUTO_START" => true,
	'TMPL_STRIP_SPACE' => true, // 是否去除模板文件里面的html空格与换行
	'SHOW_PAGE_TRACE' => true,
	'URL_CASE_INSENSITIVE' => true, // url大小写不敏感
	'URL_HTML_SUFFIX' => 'html|shtml|php',
	// 'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg', // URL禁止访问的后缀设置
	'TMPL_TEMPLATE_SUFFIX' => '.php',
	'DB_TYPE' => 'mysql',
	'DB_HOST' => '127.0.0.1', // 服务器地址
	'DB_NAME' => 'test', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => '123456', // 密码
	'DB_PORT' => 3306, // 端口
	'DB_PREFIX' => 'blog_', // 数据库表前缀
	'DB_CHARSET' => 'utf8', // 字符集
	'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增
);
