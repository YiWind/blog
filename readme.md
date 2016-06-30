# thinkphp自学 version3.2.3
新版采用模块化的设计架构，下面是一个应用目录下面的模块目录结构，每个模块可以方便的卸载和部署，并且支持公共模块。
```
Application 默认应用目录（可以设置）
├─Common 公共模块（不能直接访问）
├─Home 前台模块
├─Admin 后台模块
├─... 其他更多模块
├─Runtime 默认运行时目录（可以设置）
每个模块是相对独立的，其目录结构如下：
├─Module 模块目录
│ ├─Conf 配置文件目录
│ ├─Common 公共函数目录
│ ├─Controller 控制器目录
│ ├─Model 模型目录
│ ├─Logic 逻辑目录（可选）
│ ├─Service Service目录（可选）
│ ... 更多分层目录可选
│ └─View 视图目录
```
 # 读取配置项
每个模块会自动加载自己的配置文件（位于 Application/当前模块名/Conf/config.php ）。
```
$model = C("URL_MODEL);
```
# 模块设计
```
Application 默认应用目录（可以设置）
|--- Common 公共模块（不能直接访问） 
|--- Home 前台模块
|--- Admin 后台模块
|--- ... 其他更多模块
|--- Runtime 默认运行时目录（可以设置）
```
# 公共模块
Common模块是一个特殊的模块，是应用的公共模块，访问所有的模块之前都会首先加载公共模块下面的配置文件（ Conf/config.php ）和公共函数文件（ Common/function.php ）。但Common模块本身不能通过URL直接访问，公共模块的其他文件则可以被其他模块继承或者调用。
公共模块的位置可以通过***COMMON_PATH***常量改变，我们可以在**入口文件**中重新定义COMMON_PATH如下：
```
define('COMMON_PATH','./Common/');
define('APP_PATH','./Application/');
require './ThinkPHP/ThinkPHP.php';
```
其应用目录结构变成：
> www WEB部署目录（或者子目录）
├─index.php 入口文件
├─README.md README文件
├─Common 应用公共模块目录
├─Application 应用模块目录
├─Public 应用资源文件目录
└─ThinkPHP 框架目录
**定义之后，Application目录下面就不再需要Common目录了。**

# 自动生成模块目录[，生成后台目录]
> // 绑定Admin模块到当前入口文件
define('BIND_MODULE','Admin');
define('APP_PATH','./Application/');
require './ThinkPHP/ThinkPHP.php';
*会生成如下目录结构*
```
Application
|-- Application
   |-- Admin
   |-- Runtime
|-- Common
```

# URL模式
刚配置好的thinkphp访问index是[http://serverName/index.php/Home/Index/index](http://serverName/index.php/Home/Index/index "http://serverName/index.php/Home/Index/index")
> 如果我们直接访问入口文件的话，由于URL中没有模块、控制器和操作，因此系统会访问默认模块
（Home）下面的默认控制器（Index）的默认操作（index），因此下面的访问是等效的：
http://serverName/index.php
http://serverName/index.php/Home/Index/index Home模块，Index控制器，index操作

URL模式 | URL_MODEL 设置
---|---
普通模式 | 0
PATHINFO模式 | 1
REWRITE模式 | 2
兼容模式 | 3

**使用rewrite模式**
如果是Apache则需要在入口文件的同级添加.htaccess文件，内容如下：
```
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
```
还需要打开Apache的*LoadModule rewrite_module modules/mod_rewrite.so*模块
```
<Directory "D:/www/transfer/blog">
    Options Indexes FollowSymLinks
    AllowOverride All 开启rewrite
    Order allow,deny
    Allow from all
</Directory>
AllowOverride All|None|directive-type [directive-type] ... 
```
# 伪静态 config
设置支持的伪静态
```
'URL_HTML_SUFFIX' => 'html|shtml|xml|php'
当前访问的伪静态，比如http://serverName/home/index/index/name/liushuanhua.html
会被保存到
__EXT__变量去。上面访问的是.html，那么__EXT__为html
```
# URL大小写 config
```
'URL_CASE_INSENSITIVE' =>true
```
配置好后，即使是在Linux环境下面，也可以实现URL访问不再区分大小写了。
```
http://serverName/index.php/Home/Index/index
// 将等效于
http://serverName/index.php/home/index/index
```
这里需要注意一个地方，一旦开启了不区分URL大小写后，如果我们要访问类似**UserTypeController**的控
制器，那么正确的URL访问应该是：
```
// 正确的访问地址
http://serverName/index.php/home/user_type/index
// 错误的访问地址（linux环境下）
http://serverName/index.php/home/usertype/index
```
利用系统提供的**U方法**（后面一章URL生成会告诉你如何生成）可以为你自动生成相关的URL地址。
如果设置`'URL_CASE_INSENSITIVE' =>false`的话，URL就又变成： `http://serverName/index.php/Home/UserType/add`
# URL生成
U方法的定义规则如下（方括号内参数根据实际应用决定）：
U('地址表达式',['参数'],['伪静态后缀'],['显示域名'])
地址表达式
地址表达式的格式定义如下：
[模块/控制器/操作#锚点@域名]?参数1=值1&参数2=值2...
```
eg:
$link = U("User/index",array("name"=>"liushuanhua","age"=>25),"shtml");
echo "<a href=".$link.">".$link."</a>";
// 输出
/Home/User/index/name/liushuanhua/age/25.shtml

$link = U("Home/User/index#asd@127.0.0.1?name=asd&age=25");
echo "<a href=".$link.">".$link."</a>";
// 输出
http://127.0.0.1/Home/User/index/name/asd/age/25.html#asd
```
# Ajax ajaxReturn
ThinkPHP可以很好的支持AJAX请求，系统的 \Think\Controller 类提供了 ajaxReturn 方法用于AJAX调用后返回数据给客户端。
并且支持JSON、JSONP、XML和EVAL四种方式给客户端接受数据，并且支持配置其他方式的数据格式返回。
ajaxReturn方法调用示例：
```
$data = 'ok';
$this->ajaxReturn($data);
```
支持返回数组数据：
```
$data['status'] = 1;
$data['content'] = 'content';
$this->ajaxReturn($data);
```
默认配置采用JSON格式返回数据（通过配置DEFAULT_AJAX_RETURN进行设置）。
![默认json格式](http://ww2.sinaimg.cn/mw690/006vbNRojw1f54cjtzcq3j30be04hwee.jpg)
我们可以指定格式返回，例如：
```
// 指定XML格式返回数据
$data['status'] = 1;
$data['content'] = 'content';
$this->ajaxReturn($data,'xml'); 这样会返回一个xml格式的网页
```
xml格式如图：
![设置xml格式](http://ww3.sinaimg.cn/large/006vbNRojw1f54cnl9rl5j30ps0320sj.jpg)
# 重定向
Controller类的redirect方法可以实现页面的重定向功能。
redirect方法的参数用法和U函数的用法一致（参考URL生成部分），例如：
```
//重定向到New模块的Category操作
$this->redirect('New/category', array('cate_id' => 2), 5, '页面跳转中...');
```
上面的用法是停留5秒后跳转到New模块的category操作，并且显示页面跳转中字样，重定向后会改变当前的URL地址。

# 获取变量[获取传参]
虽然你仍然可以在开发过程中使用传统方式获取各种系统变量，例如：
>
```
$id = $_GET['id']; // 获取get变量
$name = $_POST['name']; // 获取post变量
$value = $_SESSION['var']; // 获取session变量
$name = $_COOKIE['name']; // 获取cookie变量
$file = $_SERVER['PHP_SELF']; // 获取server变量
```
但是我们不建议直接使用传统方式获取，因为没有统一的安全处理机制，后期如果调整的话，改起来会比较麻烦。所以，更好的方式是在框架中统一使用I函数进行变量获取和过滤。
I方法是ThinkPHP用于更加方便和安全的获取系统输入变量，可以用于任何地方，用法格式如下：
```
I('变量类型.变量名/修饰符',['默认值'],['过滤方法或正则'],['额外数据源'])
```

> 变量类型是指请求方式或者输入类型，包括：

变量类型|含义
---|---
get | 获取GET参数
post | 获取POST参数
param | 自动判断请求类型获取GET、POST或者PUT参数
request | 获取REQUEST 参数
put | 获取PUT 参数
session | 获取 $_SESSION 参数
cookie | 获取 $_COOKIE 参数
server | 获取 $_SERVER 参数
globals | 获取 $GLOBALS参数
path | 获取 PATHINFO模式的URL参数
data | 获取 其他类型的参数，需要配合额外数据源参数
> 注意：变量类型不区分大小写，变量名则严格区分大小写。
默认值和过滤方法均属于可选参数。

**I方法支持默认值：**
```
I('get.id',0); // 如果不存在$_GET['id'] 则返回0
I('get.name',''); // 如果不存在$_GET['name'] 则返回空字符串
```
**采用方法过滤：**
```
// 采用htmlspecialchars方法对$_GET['name'] 进行过滤，如果不存在则返回空字符串
echo I('get.name','','htmlspecialchars');
```
**支持直接获取整个变量类型，例如：**
```
// 获取整个$_GET 数组
I('get.');
```
***param变量类型***是框架特有的支持自动判断当前请求类型的变量获取方式，例如：
```
echo I('param.id');
```
如果当前请求类型是GET，那么等效于 $_GET['id']，如果当前请求类型是POST或者PUT，那么相当于获取$_POST['id'] 或者 PUT参数id。
由于param类型是I函数默认获取的变量类型，因此事实上param变量类型的写法可以简化为：
```
I('id'); // 等同于 I('param.id')
I('name'); // 等同于 I('param.name')
```
data类型变量可以用于获取不支持的变量类型的读取，例如：
```
I('data.file1','','',$_FILES);
```

# 变量过滤
如果你没有在调用I函数的时候指定过滤方法的话，系统会采用默认的过滤机制（由DEFAULT_FILTER配置），事实上，该参数的默认设置是：
```
// 系统默认的变量过滤机制
'DEFAULT_FILTER' => 'htmlspecialchars'
```
过滤类型有：htmlspecialchars，strip_tags，
详见文档**变量过滤**

# 变量修饰符
最新版本的I函数支持对变量使用修饰符功能，可以更方便的通过类型过滤变量。用法如下：
```
I('变量类型.变量名/修饰符')
```

修饰符|作用
---|---
s| 强制转换为字符串类型
d| 强制转换为整型类型
b| 强制转换为布尔类型
a| 强制转换为数组类型
f| 强制转换为浮点类型

# 判断请求类型
在很多情况下面，我们需要判断当前操作的请求类型是GET 、POST 、PUT或 DELETE，一方面可以针对请求类型作出不同的逻辑处理，另外一方面有些情况下面需要验证安全性，过滤不安全的请求。
系统内置了一些常量用于判断请求类型，包括：

常量 |说明
---|---
IS_GET| 判断是否是GET方式提交
IS_POST| 判断是否是POST方式提交
IS_PUT| 判断是否是PUT方式提交
IS_DELETE| 判断是否是DELETE方式提交
IS_AJAX| 判断是否是AJAX提交
REQUEST_METHOD |当前提交类型
使用举例如下：
```
class UserController extends Controller{
	public function update(){
		if (IS_POST){
			$User = M('User');
			$User->create();
			$User->save();
			$this->success('保存完成');
		}else{
			$this->error('非法请求');
		}
	}
}
```
# 空操作
空操作是指系统在找不到请求的操作方法的时候，会定位到空操作（ _empty ）方法来执行，利用这个机制，我们可以实现错误页面和一些URL的优化。
例如，下面我们用空操作功能来实现一个城市切换的功能。 我们只需要给CityController类定义一个_empty （空操作）方法：
```
<?php
namespace Home\Controller;
use Think\Controller;
class CityController extends Controller{
	public function _empty($name){
		//把所有城市的操作解析到city方法
		$this->city($name);
	}
	//注意 city方法 本身是 protected 方法
	protected function city($name){
		//和$name这个城市相关的处理
		echo '当前城市' . $name;
	}
}
```
# 空控制器
空控制器的概念是指当系统找不到请求的控制器名称的时候，系统会尝试定位空控制器(EmptyController)，利用这个机制我们可以用来定制错误页面和进行URL的优化。
现在我们把前面的需求进一步，把URL由原来的
```
http://serverName/index.php/Home/City/shanghai/
```
改成
```
http://serverName/index.php/Home/shanghai/
```
这样更加简单的方式，如果按照传统的模式，我们必须给每个城市定义一个控制器类，然后在每个控制器类的index方法里面进行处理。可是如果使用空控制器功能，这个问题就可以迎刃而解了。我们可以给项目定义一个EmptyController类
```
EmptyController.class.php
<?php
namespace Home\Controller;

use Think\Controller;

class EmptyController extends Controller
{
	public function _empty($name)
	{
		// **CONTROLLER_NAME**当前控制器名
		$this->show("no Controller: " . CONTROLLER_NAME . " and used function: " . $name);
	}
}
```
# 实例化模型
`D方法`和`M方法`实例化
我们在实例化的过程中，经常使用`D方法`和`M方法`，这两个方法的区别
在于M方法实例化模型无需用户为每个数据表定义模型类，
如果D方法没有找到定义的模型类，则会自动调用M方法。
自定义的模型类就是在建立
```
// Model\XxxModel.class.php D方法如果没有找到此文件就会调用M方法
<?php
namespace Home\Model;
use Think\Model;
class XxxModel extends Model {}
```
# 实例化空模型方法
```
//实例化空模型
namespace Home\Controller;
use Think\Controller;
use Think\Model;
$Model = new Model();
//或者使用M快捷方法是等效的
$Model = M();
//进行原生的SQL查询
$Model->query('SELECT * FROM think_user WHERE status = 1');
```
# 自动完成
分为**动态完成**和**静态完成**
两种方式的定义规则都采用：
```
array(
array(完成字段1,完成规则,[完成条件,附加规则]),
array(完成字段2,完成规则,[完成条件,附加规则]),
......
);
```
> 说明
完成字段（必须）
需要进行处理的数据表实际字段名称。
完成规则（必须）
需要处理的规则，配合附加规则完成。
完成时间（可选）

设置自动完成的时间，包括：

设置 |说明
---|---
self::MODEL_INSERT或者1| 新增数据的时候处理（默认）
self::MODEL_UPDATE或者2 |更新数据的时候处理
self::MODEL_BOTH或者3| 所有情况都进行处理
规则包括：

规则 |说明
---|---
function| 使用函数，表示填充的内容是一个函数名
callback |回调方法 ，表示填充的内容是一个当前模型的方法
field| 用其它字段填充，表示填充的内容是一个其他字段的值
string |字符串（默认方式）
ignore| 为空则忽略（3.1.2新增）
```
<?php
// CommonModel.class.php
namespace Home\Model;
use Think\Model;
class CommonModel extends Model {
	protected $_auto = array(
		array('is_delete','0'), 
		array('create_time','updateTime', 1, 'callback') , 
		array('update_time','updateTime',3, 'callback')
	);
	function updateTime () {
		return time();
	}
}
```
```
<?php 
// UserModel.class.php
<?php
namespace Home\Model;
use Think\Model;
class UserModel extends CommonModel {
}
```
```
// IndexController.class.php
<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends CommonController
{
	public function index()
	{	
		$User = D("User");
		$email = "369563963@qq.com";
		$pwd = md5(sha1('sadasdasd'));
		$data = array(
			"email" => $email,
			"password" => $pwd
		);
		if ($User->create($data)) {
			$User->add();
		} else {
			$User->getError();
		}		
		$this->show("end");
	}
}
```
***CREATE方法***与**修改数据对象**
在使用create方法创建好数据对象之后，此时的数据对象保存在内存中，因此仍然可以操作数据对象，包括修改或者增加数据对象的值，例如：
```
$User = D("User"); // 实例化User对象
$User->create(); // 生成数据对象
$User->status = 2; // 修改数据对象的status属性
$User->register_time = NOW_TIME; // 增加register_time属性
$User->add(); // 新增用户数据
```
一旦调用了add方法（或者save方法），创建在内存中的数据对象就会失效，如果希望创建好的数据对象在后面的数据处理中再次调用，可以保存数据对象先，例如：
```
$User = D("User"); // 实例化User对象
$data = $User->create(); // 保存生成的数据对象
$User->add();
```
不过要记得，如果你修改了内存中的数据对象并不会自动更新保存的数据对象，因此下面的用法是错误的：
```
$User = D("User"); // 实例化User对象
$data = $User->create(); // 保存生成的数据对象
$User->status = 2; // 修改数据对象的status属性
$User->register_time = NOW_TIME; // 增加register_time属性
$User->add($data);
```
上面的代码我们修改了数据对象，但是仍然写入的是之前保存的数据对象，因此对数据对象的更改操作将会无效。所以就是create会存储好数据，只需要调用add,save而不需要在add()或者save()里面加$data。
# 修改模板目录
### 方法1
```
define('TMPL_PATH','./Apps/Static/'); // 修改模板目录
结构变成了
apps
|-- Admin
|-- Home
|-- Static
    |-- Home
	|-- Admin
```
### 方法2
通过修改**config.php**文件
```
把当前模块的视图目录指定到最外层的Theme目录下面，而不是放到当前模块的View目录下面。 原来的./Application/Home/View/User/add.html 变成了 ./Theme/User/add.html 。
'VIEW_PATH'=>'./Theme/', 
```
> 如果同时定义了TMPL_PATH常量和VIEW_PATH设置参数，那么以当前模块的VIEW_PATH参数设置优先。


# 模板赋值

#### 方法1
```
控制器：
$this->name= "liushuanhua"
$this->age= "四分之一个世纪"
模板:
{$name}
{$age}
```
#### 方法2
```
控制器
$data = array(
	"name"=>"liushuanhua",
	"age"=>"四分之一个世纪"
);
$this->assign('data', $data);
模板
{$data.name} or {$data['name']}
```
