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
		$sql='SELECT vu.id,vu.account,au.num FROM vote_activity_user AS au LEFT JOIN vote_user AS vu ON au.user_id=vu.id WHERE au.activity_id='.$activityId;
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
		$activeIds=implode(',', $arr1);
		if (empty($activeIds)) {
			$activeIds='empty';
		}
		$this->assign('useractive',$useractive);
		$this->assign('userinactive',$userinactive);
		$this->assign('activityId',$activityId);
		$this->assign('activeIds',$activeIds);
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
	 * 添加所有用户
	 */
	public function addAllUser(){
		$activityId=$_GET['id'];
		$activeIds=$_GET['activeids'];
		if ($activeIds != 'empty') {
			$map['id']  = array('not in',$activeIds.',0');
		}
		$map['type']  = 0;
		$map['status']  = 1;
		$inactiveArr=M('user')->field('id')->where($map)->select();
		if (empty($inactiveArr)) {
			$this->error('当前无用户可以添加！');
		}
		$sql='INSERT INTO vote_activity_user (`activity_id`,`user_id`,`create_datetime`) VALUES ';
		$judgeParam['activity_id']=$activityId;
		$judgeParam['user_id']=$inactiveArr[0]['id'];
		$isExist=M('activity_user')->where($judgeParam)->getField('id');
		if (!empty($isExist)) {
			$this->error('无能重复添加！');
		}
		foreach ($inactiveArr as $key => $value) {
			$sql.='('.$activityId.','.$value['id'].',"'.date('Y-m-d H:i:s').'"),';
		}
		$sql=rtrim($sql,',');
		$sql.=' ON DUPLICATE KEY UPDATE activity_id=VALUES(activity_id),user_id=VALUES(user_id),create_datetime=VALUES(create_datetime)';
		// echo($sql);die;
		M()->execute($sql);
		$this->activityuserlist();
	}

	/**
	 * 删除用户
	 */
	public function deleteUser(){
		$userId=$_GET['id'];
		$sql='DELETE vu,vau,vor FROM vote_user AS vu LEFT JOIN vote_activity_user AS vau ON vu.id=vau.user_id LEFT JOIN vote_options_record AS vor ON vu.id=vor.user_id WHERE vu.id='.$userId;
		$res=M()->execute($sql);
		if (empty($res)) {
			$this->error('删除失败!');
		}else{
			$this->userlist();
		}
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
	 * 修改用户的投票数
	 */
	public function changeVoteNumid(){
		$activityId=$_GET['id'];
		$changeId=$_GET['changeid'];
		$num=$_GET['num'];
		$data['user_id']=$changeId;
		$data['activity_id']=$activityId;
		$uParam['num']=$num;
		$res=M('activity_user')->where($data)->save($uParam);
		$this->activityuserlist();
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
			if ($_FILES["myfile"]["error"] > 0)
			  {
			 	$this->error("Error: " . $_FILES["myfile"]["error"] . "<br />");
			  }
			else
			  {
			  // echo(C('UPLOAD_ACTIVITY_ADDR'));
			  // echo "Upload: " . $_FILES["myfile"]["name"] . "<br />";
			  // echo "Type: " . $_FILES["myfile"]["type"] . "<br />";die;
			  // echo "Size: " . ($_FILES["myfile"]["size"] / 1000*1000) . " M<br />";
			  // echo "Stored in: " . $_FILES["myfile"]["tmp_name"];die;
			//文件上传类型
				$uploadTypes=array('image/jpeg');
				if (!in_array($_FILES["myfile"]["type"], $uploadTypes)) {
					$this->error("上传文件类型错误，目前仅支持jpg格式！");
				}
				$maxUploadSize=2000000;//2M
				if ($_FILES["myfile"]["size"]>$maxUploadSize) {
					$this->error("上传文件最大不能超过2M！");
				}
			  	$dir=C('UPLOAD_ACTIVITY_ADDR').date('m',strtotime($starttime)).'/';
				if (!is_dir($dir)) {
					mkdir($dir,0777,true);
				}
				$newfilename=$dir.$title.'.jpg';
				$moveRes=move_uploaded_file($_FILES["myfile"]["tmp_name"],$newfilename);
				if ($moveRes==false) {
					$this->error("图片上传失败！");
				}
			}
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

	/**
	 * 查看选项列表
	 */
	public function optionlist(){
		$this->checkUserId();
		$id=!empty($_GET['id'])?$_GET['id']:$_POST['activityid'];
		$param['activity_id']=$id;
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
		$content=$_POST['addoption'];
		$activityId=$_POST['activityid'];
		// var_dump($_FILES['myfile']);die;
		if (!empty($_FILES['myfile']['name'])) {
			if ($_FILES["myfile"]["error"] > 0)
			  {
			 	$this->error("Error: " . $_FILES["myfile"]["error"] . "<br />");
			  }
			else
			  {
			  // echo(C('UPLOAD_ACTIVITY_ADDR'));
			  // echo "Upload: " . $_FILES["myfile"]["name"] . "<br />";
			  // echo "Type: " . $_FILES["myfile"]["type"] . "<br />";die;
			  // echo "Size: " . ($_FILES["myfile"]["size"] / 1000*1000) . " M<br />";
			  // echo "Stored in: " . $_FILES["myfile"]["tmp_name"];die;
			//文件上传类型
				$uploadTypes=array('image/jpeg');
				if (!in_array($_FILES["myfile"]["type"], $uploadTypes)) {
					$this->error("上传文件类型错误，目前仅支持jpg格式！");
				}
				$maxUploadSize=2000000;//2M
				if ($_FILES["myfile"]["size"]>$maxUploadSize) {
					$this->error("上传文件最大不能超过2M！");
				}
			  	$dir=C('UPLOAD_OPTION_ADDR').'a'.$activityId.'/';
				if (!is_dir($dir)) {
					mkdir($dir,0777,true);
				}
				
			}
		}
		$addparam['options_content']=$content;
		$addparam['activity_id']=$activityId;
		$addparam['status']=1;
		$isnull=M('activity_options')->where($addparam)->find();
		if (empty($isnull)) {
			$addparam['create_datetime']=date('Y-m-d H:i:s');
			$addRes=M('activity_options')->data($addparam)->add();
			$newfilename=$dir.'/'.$addRes.'.jpg';
			$moveRes=move_uploaded_file($_FILES["myfile"]["tmp_name"],$newfilename);
			if ($moveRes==false && !empty($_FILES['myfile']['name'])) {
				$this->error("图片上传失败！");
			}
			$this->optionlist();
		}else{
			$this->error('请不要重复插入！');
		}
		
	}

	/**
	 * 查看投票结果
	 */
	public function voteresult(){
		$this->checkUserId();
		$params['status']=1;
		$activityList = M('activity')->where($params)->select();
		$this->assign('activitylist',$activityList);
		// var_dump($activityList);
		$this->display('voteresult');
	}

	/**
	 * 查看投票结果 - item
	 */
	public function resultitem(){
		$activityId = $_GET['id'];
		$activityTitle = $_GET['title'];
		//query option_list
		$params['status']=1;
		$params['activity_id']=$activityId;
		$optionsList=M('activity_options')->where($params)->select();

		//query option_user_list
		$sql='SELECT count(option_id) AS counts,option_id FROM vote_options_record WHERE status=1 AND activity_id='.$activityId.' GROUP BY option_id';
		$optionUserList=M()->query($sql);
		$arr1 = array();
		foreach ($optionUserList as $key => $value) {
			$arr1[$value['option_id']]=$value['counts'];
		}
		foreach ($optionsList as $k => &$v) {
			if (!isset($arr1[$v['id']])) {
				$v['num']= 0;
			}else{
				$v['num'] = $arr1[$v['id']];
			}
		}
		// var_dump($optionsList);die;
		$this->assign('activityId',$activityId);
		$this->assign('title',$activityTitle);
		$this->assign('optionsList',$optionsList);
		$this->display();
	}

	/**
	 * 
	 */
	public function resultitemuser(){
		$optionId = $_GET['id'];
		$optionTitle = $_GET['title'];
		$activityId = $_GET['activityId'];
		$activityTitle = $_GET['activityTitle'];
		$sql='SELECT vu.account FROM vote_options_record AS vor LEFT JOIN vote_user AS vu ON vor.user_id=vu.id WHERE vor.status=1 AND vor.option_id = '.$optionId;
		$userList=M()->query($sql);
		$this->assign('userList',$userList);
		$this->assign('optionId',$optionId);
		$this->assign('optionTitle',$optionTitle);
		$this->assign('activityId',$activityId);
		$this->assign('activityTitle',$activityTitle);
		$this->display();
	}

	/**
	 * 选项维护
	 */
	public function optionmaintain(){

	}






}