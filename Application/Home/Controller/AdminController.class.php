<?php
namespace Home\Controller;
use Home\Controller\CommonController;
/**
* @author jie.geng
*/
class AdminController extends CommonController
{
	// public function _before_index(){
	// 	session_start();
	// 	echo(11);die;
 //        // session_unset();
 //        // session_destroy();
	// 	if (!isset($_SESSION['USERID'])) {
 //            $this->error('请重新登录');die;
 //        }else{
 //        	$userId=$_SESSION['USERID'];
 //        }
	// }
	/**
	 * 用户维护
	 */
	public function userlist(){
		session_start();
    	$userId=$_SESSION['USERID'];
    	$userArr=M('user')->select();
    	$this->assign('userArr',$userArr);
    	$this->display('userlist');
		// var_dump($userId);die;	
	}

	/**
	 * 新增用户
	 */
	public function insertaccount(){
		$account=$_POST['newaccount'];
		$passwd=$_POST['newpasswd'];
		$param['account']=$account;
		$param['passwd']=$passwd;
		$param['status']=1;
		$param['type']=0;
		$param['create_datetime']=date('Y-m-d H:i:s',time());
		$res=M('user')->data($param)->add();
		if (empty($res)) {
			$this->error('操作失败！');
		}else{
			$this->userlist();
		}
	}

	/**
	 * 账号密码修改
	 */
	public function changepasswd(){
		$id=$_POST['userid'];
		$passwd=$_POST['passwd'];
		$sql='UPDATE vote_user SET passwd="'.$passwd.'" WHERE id='.$id;
		$res=M()->execute($sql);
		if (empty($res)) {
			$this->error('操作失败！');
		}else{
			$this->userlist();
		}
	}

	/**
	 * 账号状态切换
	 */
	public function toggleaccount(){
		$id=$_GET['id'];
		$sql='UPDATE vote_user SET status=status^1 WHERE id='.$id;
		$res=M()->execute($sql);
		if (empty($res)) {
			$this->error('操作失败！');
		}else{
			$this->userlist();
		}
	}

	/**
	 * 添加活动
	 */
	public function createactivity(){
		if (IS_POST) {
			# code...
		}else{
			$activityArr=M('activity')->where('status=1')->select();
			$this->assign('activityArr',$activityArr);
			$this->display('activity');
		}
	}

	/**
	 * 选项维护
	 */
	public function optionmaintain(){

	}
}