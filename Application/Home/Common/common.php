<?php
//公共函数
function isActive($sideOrder,$value) {
	if ($sideOrder==$value) {
		return 'class="active"';
	}else{
		return '';
	}
}

?>