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
	 * 投票统计
	 */
	public function countBaseOptions($id){
		$sql='SELECT COUNT(DISTINCT(vor.id)) AS num,ao.options_content FROM vote_options_record AS vor LEFT JOIN vote_activity_options AS ao ON vor.option_id=ao.id WHERE vor.activity_id='.$id.' AND vor.status=1 GROUP BY vor.option_id ORDER BY vor.id';
		// echo($sql);die;
		$res=M()->query($sql);
		$sum=0;
		foreach ($res as $key => $value) {
			$sum+=$value['num'];
		}
		$result=array(
				'countInfo'=>$res,
				'sum'=>$sum,
			);
		return $result;
		// $this->assign('countInfo',$res);
		// $this->assign('sum',$sum);
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