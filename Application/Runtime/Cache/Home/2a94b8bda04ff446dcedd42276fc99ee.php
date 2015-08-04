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
<div class="page-header">
  <h2>泰笛洗涤<small>投票系统</small>
  	<?php if($userid): ?><a href="/tpvote/index.php/Home/Index/logout">退出</a>
  	<?php else: endif; ?>
  </h2>
</div>

	<div class="container">
		<!-- 活动主题 -->
		<div class="row activity-title">
			<p><?php echo ($title); ?></p>
		</div>
		<div class="row activity-content">
			<p><?php echo ($content); ?></p>
		</div>
		<div class="row activity-time">
			<p>活动执行时间：<?php echo ($strDatetime); ?> —— <?php echo ($endDatetime); ?></p>
		</div>
		<div class="row options">
			<?php if(is_array($options)): $i = 0; $__LIST__ = $options;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="option_item">
					<div class="option_item_content">
						<?php echo ($vo["options_content"]); ?>
					</div>
					<div class="option_item_num">
						已投票数：<?php echo ($vo["num"]); ?>
					</div>
					<div class="option_item_link">
						<a href="/tpvote/index.php/Home/Index/vote/id/<?php echo ($vo["id"]); ?>">我要投票</a>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</div>
<footer>
	
</footer>
</body>
</html>