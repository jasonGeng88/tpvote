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
	 * 验证session['USERID']是否存在
	 */
	public function checkUserId(){
		session_start();
		if (isset($_SESSION['USERID'])) {
			$this->assign('userid',$_SESSION['USERID']);
		}else{
			$this->error('请重新登录');die;
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