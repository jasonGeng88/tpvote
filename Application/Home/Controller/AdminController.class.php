<?php
namespace Home\Controller;
use Home\Controller\CommonController;
/**
* @author jie.geng
*/
class AdminController extends CommonController
{
	/**
	 * 用户维护
	 */
	public function userlist(){
		$this->checkUserId();
    	$userId=$_SESSION['USERID'];
    	$userArr=M('user')->select();
    	$this->assign('userArr',$userArr);
    	$this->assign('sideOrder','userlist');
    	$this->display('userlist');
		// var_dump($userId);die;	
	}

	/**
	 * 活动用户
	 */
	public function activityuser(){
		$this->checkUserId();
		// $activityId=$_GET['id'];
		$param['status']=1;
		$activityArr=M('activity')->field('id,title')->where($param)->select();
    	$this->assign('activityArr',$activityArr);
    	$this->assign('sideOrder','activityuser');
		$this->display('activityuser');
	}

	/**
	 * 活用用户列表
	 */
	public function activityuserlist(){
		$activityId=$_GET['id'];
		//激活的用户
		$sql='SELECT vu.id,vu.account FROM vote_activity_user AS au LEFT JOIN vote_user AS vu ON au.user_id=vu.id WHERE au.activity_id='.$activityId;
		$useractive=M()->query($sql);
		$arr1=array();
		foreach ($useractive as $key => $value) {
			$arr1[]=$value['id'];
		}
		//未激活的用户
		$userinactive=array();
		$res=M('user')->where('status=1 AND type=0')->select();
		foreach ($res as $k => $v) {
			if (!in_array($v['id'], $arr1)) {
				$userinactive[$v['id']]['id']=$v['id'];
				$userinactive[$v['id']]['account']=$v['account'];
			}
		}
		$this->assign('useractive',$useractive);
		$this->assign('userinactive',$userinactive);
		$this->assign('activityId',$activityId);
		$this->activityuser();
		// M('activity_user')->field('user_id')->where($activityParam)->select();
	}

	/**
	 * 添加活动用户
	 */
	public function addActivityUser(){
		$userId=$_GET['addid'];
		$activityId=$_GET['id'];
		$addParam['activity_id']=$activityId;
		$addParam['user_id']=$userId;
		$addParam['create_datetime']=date('Y-m-d H:i:s');
		M('activity_user')->data($addParam)->add();
		$this->activityuserlist();
	}

	/**
	 * 删除活动用户
	 */
	public function deleteActivityUser(){
		$userId=$_GET['deleteid'];
		$activityId=$_GET['id'];
		$deleteParam['activity_id']=$activityId;
		$deleteParam['user_id']=$userId;
		$res=M('activity_user')->where($deleteParam)->delete();
		$this->activityuserlist();
	}

	/**
	 * 新增用户
	 */
	public function insertaccount(){
		$this->checkUserId();
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
		$this->checkUserId();
		$id=$_POST['userid'];
		$passwd=$_POST['passwd'];
		$this->checkParams(array($id,$passwd));
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
		$this->checkUserId();
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
	 * 活动列表
	 */
	public function activitylist(){
		$this->checkUserId();
		$activityArr=M('activity')->where('status=1')->order('create_datetime desc')->select();
		$this->assign('sideOrder','activitylist');
		$this->assign('activityArr',$activityArr);
		$this->display('activitylist');
	}

	/**
	 * 创建新活动
	 */
	public function createactivity(){
		$this->checkUserId();
		if (IS_POST) {
			$title=$_POST['title'];
			$content=$_POST['content'];
			$starttime=$_POST['starttime'];
			$endtime=$_POST['endtime'];
        	$this->checkParams(array($title,$content,$starttime,$endtime));
        	if ($starttime>$endtime) {
				$this->error('活动开始不能早于结束时间！');
        	}
        	$res=M('activity')->where('title="'.$title.'"')->find();
        	if (!empty($res)) {
				$this->error('活动已存在！');
        	}
			$param['title']=$title;
			$param['content']=$content;
			$param['start_datetime']=$starttime.' 00:00:00';
			$param['end_datetime']=$endtime.' 23:59:59';
			$param['create_datetime']=date('Y-m-d H:i:s');
			$param['status']=1;
			M('activity')->data($param)->add();
			$this->activitylist();
		}else{
			$this->assign('sideOrder','createactivity');
			$this->display('createactivity');
		}
	}

	/**
	 * 添加活动选项
	 */
	public function addoptions(){
		$this->checkUserId();
		if (IS_POST) {
			# code...
		}else{
			$curDate=date('Y-m-d H:i:s');
			// $param['start_datetime']=array('lt',$curDate);
			// $param['end_datetime']=array('gt',$curDate);
			$param['status']=1;
			$res=M('activity')->field('id,title')->where($param)->select();
			if (empty($res)) {
				$this->error('当前无活动，请去添加活动');
			}else{
				$this->assign('sideOrder','addoptions');
				$this->assign('activity',$res);
				$this->display('addoption');
			}
		}
	}

	/**
	 * 查看选项列表
	 */
	public function optionlist(){
		$this->checkUserId();
		$id=$_GET['id'];
		$param['activity_id']=$_GET['id'];
		$param['status']=1;
		$optionsArr=M('activity_options')->field('id,options_content')->where($param)->select();
		// var_dump($optionsArr);die;
		$this->assign('activityId',$id);
		$this->assign('optionsArr',$optionsArr);
		$this->addoptions();
	}

	/**
	 * 删除选项
	 */
	public function deleteoption(){
		$this->checkUserId();
		$deleteid=$_GET['deleteid'];
		$deleteParam['id']=$deleteid;
		$deleteRes=M('activity_options')->where($deleteParam)->delete();
		if (empty($deleteRes)) {
			$this->error('删除失败！');
		}else{
			$this->optionlist();
		}
	}

	/**
	 * 添加选项
	 */
	public function addoption(){
		$this->checkUserId();
		$content=$_GET['content'];
		$activityId=$_GET['id'];
		$addparam['options_content']=$content;
		$addparam['activity_id']=$activityId;
		$addparam['status']=1;
		$isnull=M('activity_options')->where($addparam)->find();
		if (empty($isnull)) {
			$addparam['create_datetime']=date('Y-m-d H:i:s');
			M('activity_options')->data($addparam)->add();
			$this->optionlist();
		}else{
			$this->error('请不要重复插入！');
		}
		
	}

	/**
	 * 选项维护
	 */
	public function optionmaintain(){

	}






}