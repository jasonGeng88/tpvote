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
<!-- <div class="page-header">
  <h2>泰笛洗涤<small>投票系统</small>
  	<?php if($userid): ?><a href="/tpvote/index.php/Home/Index/logout">退出</a>
  	<?php else: endif; ?>
  </h2>
</div> -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/tpvote/index.php">投票系统</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
        <li class="active"><a href="/tpvote/index.php">首页 <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <!--<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
      	<li>
      	<?php if($userid): ?><a href="/tpvote/index.php/Home/index/logout">退出</a>
	  	<?php else: ?><a href="/tpvote/index.php">登录</a><?php endif; ?>
        </li>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="left-side col-xs-2">
	<ul class="nav nav-list sidebar">
		<li class="nav-header">
			用户维护
		</li>
		<li <?php echo (isActive($sideOrder,"userlist")); ?>>
			<a href="/tpvote/index.php/Home/admin/userlist">用户列表</a>
		</li>
		<li <?php echo (isActive($sideOrder,"activityuser")); ?>>
			<a href="/tpvote/index.php/Home/admin/activityuser">活动用户</a>
		</li>
		<li class="nav-header">
			活动维护
		</li>
		<li <?php echo (isActive($sideOrder,"createactivity")); ?>>
			<a href="/tpvote/index.php/Home/admin/createactivity">创建活动</a>
		</li>
		<li <?php echo (isActive($sideOrder,"activitylist")); ?>>
			<a href="/tpvote/index.php/Home/admin/activitylist">活动列表</a>
		</li>
		<li class="nav-header">
			选项维护
		</li>
		<li <?php echo (isActive($sideOrder,"addoptions")); ?>>
			<a href="/tpvote/index.php/Home/admin/addoptions">添加选项</a>
		</li>
		<li class="divider">
		</li>
		<!-- <li>
			<a href="#">帮助</a>
		</li> -->
	</ul>
	<!-- <div class="accordion" id="accordion-910278">
		<div class="accordion-group">
			<div class="accordion-heading">
				 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-314631">用户维护</button>
			</div>
			<div id="accordion-element-314631" class="accordion-body in collapse">
				<div class="accordion-inner">
					<a href="/tpvote/index.php/Home/admin/userlist">用户列表</a>
				</div>
				<div class="accordion-inner active">
					<a href="/tpvote/index.php/Home/admin/usermaintain">用户维护</a>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866551">活动维护</button>
			</div>
			<div id="accordion-element-866551" class="accordion-body collapse">
				<div class="accordion-inner">
					<a href="/tpvote/index.php/Home/admin/createactivity">创建活动</a>
				</div>
				<div class="accordion-inner">
					<a href="/tpvote/index.php/Home/admin/activitylist">活动列表</a>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<div class="accordion-heading">
				 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866552">选项维护</button>
			</div>
			<div id="accordion-element-866552" class="accordion-body collapse">
				<div class="accordion-inner">
					<a href="/tpvote/index.php/Home/admin/addoptions">添加活动选项</a>
				</div>
			</div>
		</div>
	</div> -->

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