<?php
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	die('require PHP > 5.3.0 !');
}

define('COMMON_PATH', './Common/');
// 绑定Admin模块到当前入口文件（生成控制器类）
//define('BIND_MODULE', 'Admin');
//define('BUILD_CONTROLLER_LIST', 'Index,User,Menu');
//define('APP_PATH', './Application/');

// 绑定Admin模块到当前入口文件（生成模型类）
//define('BIND_MODULE', 'Admin');
//define('BUILD_MODEL_LIST', 'User,Menu');
//define('APP_PATH', './Application/');
define('APP_DEBUG', True); // 开启调试模式
define('APP_PATH', './Apps/');
//define('BIND_MODULE', 'Admin'); // 绑定模块，默认就是Home
define('BUILD_DIR_SECURE', false);
define('TMPL_PATH', './Apps/Template/'); // 修改模板目录
require './ThinkPHP/ThinkPHP.php';