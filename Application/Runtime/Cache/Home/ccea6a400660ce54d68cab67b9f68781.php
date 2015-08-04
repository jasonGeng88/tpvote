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

<div class="container">
	<div class="row">	
		<form action="/tpvote/index.php/Home/Index/submit" method="post" onsubmit="return ajaxreturn(this)">
			<div class="input-group">
			  <input type="text" name="username" class="form-control" placeholder="用户名">
			</div>

			<div class="input-group">
			  <input type="password" name="passwd" class="form-control" placeholder="密码">
			</div>

			<?php if($error): ?><div class="alert alert-danger" role="alert"><?php echo ($error); ?></div>
				<?php else: endif; ?>
			<div class="input-group">
			  <input type="submit" class="form-control" value="提交">
			</div>
		</form>
	</div>
</div>
</div>
<footer>
	
</footer>
</body>
</html>