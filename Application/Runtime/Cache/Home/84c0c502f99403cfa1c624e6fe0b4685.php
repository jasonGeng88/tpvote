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
  	<?php if($userid): ?><a href="/tpvote/index.php/Home/Admin/logout">退出</a>
  	<?php else: endif; ?>
  </h2>
</div>

<div class="left-side col-xs-2">
		<!-- <div class="row ">
			<ul class="nav nav-pills nav-stacked">
				<li role="presentation" class="active"><a href="/tpvote/index.php/Home/Admin/usermaintain">用户维护</a></li>
				<li role="presentation"><a href="/tpvote/index.php/Home/Admin/activitymaintain">活动维护</a></li>
				<li role="presentation"><a href="/tpvote/index.php/Home/Admin/optionmaintain">选项维护</a></li>
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
						<a href="/tpvote/index.php/Home/Admin/usermaintain">用户维护</a>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866551">活动维护</button>
				</div>
				<div id="accordion-element-866551" class="accordion-body collapse">
					<div class="accordion-inner">
						<a href="/tpvote/index.php/Home/Admin/createactivity">创建活动</a>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					 <button class="accordion-toggle btn btn-primary btn-block" data-toggle="collapse" data-parent="#accordion-910278" href="#accordion-element-866552">选项维护</button>
				</div>
				<div id="accordion-element-866552" class="accordion-body collapse">
					<div class="accordion-inner">
						<a href="/tpvote/index.php/Home/Admin/caoptions">添加活动选项</a>
					</div>
				</div>
			</div>
		</div>

</div>
<style type="text/css">
	.change_form{
		display: none;
		position: absolute;
		width: 100%;
		height: 100%;
		left: 0;
		top: 0;
	}
	.layout{
		position: absolute;
		width: 100%;
		height: 100%;
		opacity: 0.7;
		background: #000000;
		z-index: 5;
	}
	.change_form .form-content{
		position: absolute;
		width: 50%;
		height: 50%;
		left: 25%;
		top: 25%;
		z-index: 6;
		background: #ffffff;
		border-radius: 8px;
		padding: 20px;
	}
	#submit{
		margin-bottom: 5px;
	}
	.insert_row{
		margin-bottom: 10px;
	}
</style>
<script type="text/javascript">
	$(function(){
		$('.layout').click(function(){
			$('.change_form').css('display','none');
		});
	});
	function changePasswd(id){
		// var url='/tpvote/index.php/Home/Admin/changePasswd/id/'+id;
		// $('.change_form form').attr('action',url);
		$("#userid").val(id);
		var fieldH=$('fieldset').height();
		var formH=$('.form-content').height();
		console.log(formH-fieldH);
		$('#passwd').css('margin-bottom',formH-fieldH);
		$('.change_form').css('display','block');

		// var userid=$("#userid").val();

		// window.location='/tpvote/index.php/Home/Admin/changePasswd/id/'+id;
	}
</script>
<div class="row col-xs-10 insert_row">
	<form action="/tpvote/index.php/Home/Admin/insertaccount" method="post">
		<div class="row col-xs-2">
		新增用户：
		</div>
		<div class="row col-xs-4">
			用户名：<input type="text" name="newaccount">
		</div>
		<div class="row col-xs-4">
			密码：<input type="text" name="newpasswd">
		</div>
		<div class="row col-xs-3">
			<button type="submit" class="btn btn-primary btn-sm">新增</button>
		</div>
	</form>
</div>
<div class="row col-xs-10">
	<ul class="list-group">
	  <li class="list-group-item">
	  	<div class="row col-xs-4">账号</div>
	  	<div class="row col-xs-4">类型</div>
	  	<div class="row col-xs-4">状态</div>
	  </li>

	  <?php if(is_array($userArr)): $i = 0; $__LIST__ = $userArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="list-group-item">
	  		<div class="row col-xs-4"><?php echo ($vo["account"]); ?></div>
		  	<div class="row col-xs-4">
			  	<?php if($vo["type"] == 0): ?>用户
			  		<?php else: ?>管理员<?php endif; ?>
		  	</div>
		  	<div class="row col-xs-4">
		  		<?php if($vo["status"] == 1): ?><a href="/tpvote/index.php/Home/Admin/toggleaccount/id/<?php echo ($vo["id"]); ?>">禁用</a>
		  			<?php else: ?>
		  			<a href="/tpvote/index.php/Home/Admin/toggleaccount/id/<?php echo ($vo["id"]); ?>">启用</a><?php endif; ?>
	  			<a href="javascript:void(0);" onclick="changePasswd(<?php echo ($vo["id"]); ?>)">密码修改</a>
		  		
		  	</div>
	  	</li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<div class="row change_form">
	<div class="layout"></div>
	<div class="form-content">
		<form action="/tpvote/index.php/Home/Admin/changePasswd" method="post">
			<fieldset>
				<legend>密码修改</legend>
				 <label>新密码：</label>
				 <input type="hidden" class="form-control" placeholder="" name="userid" id="userid">
				 <input type="text" class="form-control" placeholder="" name="passwd" id="passwd">
				 <!-- <input type="text" />  -->
				 <!-- <span class="help-block">这里填写帮助信息.</span>  -->
				 <!-- <label class="checkbox"><input type="checkbox" /> 勾选同意</label>  -->
				 <button type="submit" class="btn btn-block btn-primary" id="submit">提交</button>
			</fieldset>
		</form>
	</div>
	
	<!-- <form action="" method="post">
		<div class="input-group">
		  <label>新密码：</label>
		  <input type="text" class="form-control" placeholder="" name="passwd" id="passwd">
		</div>
		<div class="input-group">
		  <button type="submit" class="form-control btn btn-block btn-primary" value="提交" name="submit" id="submit">提交
		  </button>
		</div>
	</form> -->
</div>


</div>
<footer>
	
</footer>
</body>
</html>