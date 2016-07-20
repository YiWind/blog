<?php
namespace Admin\Model;

use Think\Model;

class CommonModel extends Model
{
	protected $_auto = array(
		array('is_delete', '0'),
		array('create_time', 'updateTime', 1, 'callback'),
		array('update_time', 'updateTime', 3, 'callback')
	);

	function updateTime()
	{
		return time();
	}
}