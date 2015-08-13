<?php
$dbconfig=require 'db.php';
$config=array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM'=>'{',
	'TMPL_R_DELIM'=>'}',
	'HOST_ADDR'=>'http://www.942sf.cn/',
	// 'UPLOAD_ACTIVITY_ADDR'=>__ROOT__.'/Application/uploads/activity/',
	'UPLOAD_ACTIVITY_ADDR'=>APP_PATH.'uploads/activity/',
	'IMG_ACTIVITY_ADDR'=>'http://localhost/tpvote/'.APP_PATH.'uploads/activity/',
	// 'IMG_ACTIVITY_ADDR'=>'../../../'.APP_PATH.'uploads/activity/',
	// 'UPLOAD_OPTION_ADDR'=>__ROOT__.'/Application/uploads/option/',
	'UPLOAD_OPTION_ADDR'=>APP_PATH.'uploads/option/',
	// 'IMG_OPTION_ADDR'=>APP_PATH.'uploads/option/',
	'IMG_OPTION_ADDR'=>'http://localhost/tpvote/'.APP_PATH.'uploads/option/',
);
return array_merge($config,$dbconfig);
?>