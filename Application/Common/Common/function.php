<?php
	/**
	 * 验证参数不为空（支持一维数组）
	 */
	function checkParams($params){
		if (is_array($params)) {
			foreach ($array as $value) {
				if (empty($value)) {
					$data = '参数不能为空！';
					$this->ajaxReturn($data);	
				}
			}
		}else{
			if (empty($params)) {
				$data = '参数不能为空！';
				$this->ajaxReturn($data);	
			}
		}
		
	}

	/**
	 * 定位侧边栏
	 */
	function isActive($sideOrder,$value) {
		if ($sideOrder==$value) {
			return 'class="active"';
		}else{
			return '';
		}
	}
?>