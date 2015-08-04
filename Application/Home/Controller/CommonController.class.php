<?php
namespace Home\Controller;
use Think\Controller;
/**
 * @author jie.geng
 */
class CommonController extends Controller
{
	/**
	 * 验证参数不为空（支持一维数组）
	 */
	public function checkParams($params){
		if (is_array($params)) {
			foreach ($params as $value) {
				if (empty($value)) {
					$this->error('参数不能为空！')	;
				}
			}
		}else{
			if (empty($params)) {
				$this->error('参数不能为空！')	;
			}
		}
		
	}

	/**
	 * ajaxreturn-success
	 */
	public function success($data){
		$this->ajaxReturn($data,"JSON",200);
	}

	/**
	 * ajaxreturn-error
	 */
	public function error($data){
		$this->ajaxReturn($data,"JSON",404);
	}






}