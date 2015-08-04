<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<script src="/tpvote/Public/bower_components/jquery/dist/jquery.min.js"></script>

<script src="/tpvote/Public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="/tpvote/Public/js/custom.js"></script>

<!-- <script src="/tpvote/Public/dist/onewash.min.js"></script> -->

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="/tpvote/Public/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="css/custom.css"> -->
<link rel="stylesheet" href="/tpvote/Public/css/custom.css">
<title>泰笛投票系统</title>
</head>
<body>
<div class="container">
<div class="page-header">
  <h2>泰笛洗涤<small>投票系统</small>
  	<?php if($userid): ?><a href="/tpvote/index.php/Home/Index/logout">退出</a>
  	<?php else: endif; ?>
  </h2>
</div>

<div class="left-side col-xs-2">
		<!-- <div class="row ">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="/tpvote/index.php/Home/Index/usermaintain">用户维护</a></li>
				<li role="presentation"><a href="/tpvote/index.php/Home/Index/activitymaintain">活动维护</a></li>
				<li role="presentation"><a href="/tpvote/index.php/Home/Index/optionmaintain">选项维护</a></li>
			</ul>
		</div> -->
		<div class="accordion" id="accordion-910278">
			<div class="accordion-group">
				<div class="accordion-heading">
					 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-314631">用户维护</button>
				</div>
				<div id="accordion-element-314631" class="accordion-body in collapse">
					<div class="accordion-inner">
						<a href="/tpvote/index.php/Home/admin/userlist">用户列表</a>
					</div>
					<div class="accordion-inner">
						<a href="/tpvote/index.php/Home/Index/usermaintain">新增用户</a>
					</div>
					<div class="accordion-inner">
						<a href="/tpvote/index.php/Home/Index/usermaintain">用户维护</a>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866551">活动维护</button>
				</div>
				<div id="accordion-element-866551" class="accordion-body collapse">
					<div class="accordion-inner">
						功能块...
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866551">选项维护</button>
				</div>
				<div id="accordion-element-866551" class="accordion-body collapse">
					<div class="accordion-inner">
						功能块...
					</div>
				</div>
			</div>
		</div>

</div>
<div class="row col-xs-10">
	<div class="jumbotron">
	  <h1>后台管理系统</h1>
	</div>
</div>
</div>
<footer>
	
</footer>
</body>
</html>