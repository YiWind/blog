<!doctype html>
<html>

<head>
	<meta charset="UTF-8"/>
	<title>Document</title>
	<link rel="stylesheet" href="http://g.alicdn.com/sj/dpl/1.5.1/css/sui.min.css"/>
	<link rel="stylesheet" href="__STATIC__/css/style.css"/>
	<script src="__STATIC__/js/jquery.min.js"></script>
	<script src="http://g.alicdn.com/sj/dpl/1.5.1/js/sui.min.js"></script>
	<link rel="stylesheet" href="http://cdn.bootcss.com/datatables/1.10.12/css/jquery.dataTables.min.css"/>
	<script src="http://cdn.bootcss.com/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
</head>

<body>
<div class="page">
	<div class="sui-navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="sui-container"><a href="#" class="sui-brand">Admin</a>
				<ul class="sui-nav">
					<li class="active"><a href="#">文章</a></li>
				</ul>
				<ul class="sui-nav pull-right">
					<li class="sui-dropdown"><a href="javascript:void(0);" data-toggle="dropdown"
					                            class="dropdown-toggle">admin</a>
						<ul role="menu" class="sui-dropdown-menu">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">退出</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="#">关于</a></li>
						</ul>
					</li>
				</ul>
				<form class="sui-form sui-form pull-right">
					<input type="text" placeholder="宝贝/店铺名称...">
					<button class="sui-btn">搜索</button>
				</form>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="main-left">
			<ul class="sui-nav nav-list">
				<li class="nav-header">文章</li>
				<li class="active"><a href="">文章列表</a></li>
				<li><a>文章分类列表</a></li>
			</ul>
		</div>
		<div class="main">
			<ul class="sui-breadcrumb">
				<li><a href="#">文章</a></li>
				<li class="active">文章列表</li>
			</ul>
			<div class="main-content">
				<table class="asdasdas">
					<thead>
					<tr>
						<th>选择</th>
						<th>id</th>
						<th>标题</th>
						<th>点击数</th>
						<th>点赞数</th>
						<th>创建时间</th>
						<th>更新时间</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php
					foreach ($list as $key => $value) {
						?>
						<tr>
							<td>
								<input type="checkbox">
							</td>
							<td><?= $value['id'] ?></td>
							<td><?= $value['title'] ?></td>
							<td><?= $value['views'] ?></td>
							<td><?= $value['likes'] ?></td>
							<td><?= date("Y-m-d H:i:s", $value['create_time']) ?></td>
							<td><?= date("Y-m-d H:i:s", $value['update_time']) ?></td>
							<td>
								<a href="#">编辑</a>
								<a href="#">删除</a>
							</td>
						</tr>
						<?php

					}
					?>
					</tbody>
				</table>
				<div class="sui-btn-toolbar">
					<div class="sui-btn-group">
						<button class="sui-btn btn-large">全选</button>
						<button class="sui-btn btn-danger btn-large">删除</button>
						<a href="#" class="sui-btn btn-primary btn-large">新建</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('.asdasdas').DataTable({
		});
	});
</script>
</body>

</html>