<?php
$dbconfig=require 'db.php';
$config=array(
	//'配置项'=>'配置值'
	'TMPL_L_DELIM'=>'{',
	'TMPL_R_DELIM'=>'}',
	'HOST_ADDR'=>'localhost',
);
return array_merge($config,$dbconfig);
?>