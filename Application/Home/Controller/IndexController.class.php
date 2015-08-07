<?php
namespace Home\Controller;
use Home\Controller\CommonController;
/**
 * @author jie.geng
 */
class IndexController extends CommonController {
	/**
	 * 登录验证
	 */
	public function _before_index(){
		session_start();
        // session_unset();
        // session_destroy();
		if (isset($_SESSION['USERID']) && $_SESSION['USERTYPE']==0) {

		}else if(isset($_SESSION['USERID']) && $_SESSION['USERTYPE']==1){
            $this->admin();die;
        }else{
            $this->display('login');die;
        }
	}

    /**
     * 用户登录后首页
     */
    public function index(){
        $userId=$_SESSION['USERID'];
        $curDate=date('Y-m-d');
            // var_dump($_SESSION['USERID']);die;
        $sql='SELECT DISTINCT(va.id),va.title,va.content,va.start_datetime,va.end_datetime FROM vote_activity AS va LEFT JOIN vote_activity_user AS au ON va.id=au.activity_id WHERE va.status=1 AND au.user_id='.$userId.' AND DATE_FORMAT(va.start_datetime,"%Y-%m-%d")<="'.$curDate.'" AND DATE_FORMAT(va.end_datetime,"%Y-%m-%d")>="'.$curDate.'"';
        // echo($sql);die;
        $res=M()->query($sql);
        // var_dump($res);die;
        if (!empty($res)) {
            //活动信息
            // $param2['activity_id']=$res['activity_id'];
            // $param2['status']=1;
            // $activityArr=M('activity')->where($param2)->find();
            // $curTime=time();
            // $this->assign('title',$activityArr['title']);
            // $this->assign('content',$activityArr['content']);
            // $this->assign('strDatetime',$activityArr['start_datetime']);
            // $this->assign('endDatetime',$activityArr['end_datetime']);
            // //活动选项

            // // $param3['activity_id']=$res['activity_id'];
            // // $param3['status']=1;
            // $sql='SELECT count(vor.id) AS num, vao.id,vao.`options_content` FROM vote_activity_options AS vao LEFT JOIN `vote_options_record` AS vor ON vao.id=vor.option_id WHERE vao.status=1 AND vao.`activity_id`='.$res['activity_id'].' GROUP BY vao.id';
            // $optionsArr=M()->query($sql);
            // var_dump($optionsArr);die;
            $this->assign('activityArr',$res);

            $this->assign('userid',$userId);

            $this->display('index');
           
        }else{
            $this->error('暂无活动');
        }
    }

    /**
     * 单个活动投票内容
     */
    public function activityInfo(){
        $userId=$_SESSION['USERID'];
        $activityId=$_GET['id'];
        $activityInfo=M('activity')->where('id='.$activityId)->find();
        $sql='SELECT count(vor.id) AS num, vao.id,vao.`options_content` FROM vote_activity_options AS vao LEFT JOIN `vote_options_record` AS vor ON vao.id=vor.option_id WHERE vao.status=1 AND vao.`activity_id`='.$activityId.' GROUP BY vao.id';
        $optionsArr=M()->query($sql);
        $this->assign('userid',$userId);
        $this->assign('activityInfo',$activityInfo);
        $this->assign('optionsArr',$optionsArr);
        $this->display('activityitem');
    }


    // public function index(){
    //     $userId=$_SESSION['USERID'];
    //         // var_dump($_SESSION['USERID']);die;
    //     $param1['user_id']=2;
    //     $param1['status']=1;
    // 	$res=M('activity_user')->field('activity_id')->where($param1)->find();
    //     // var_dump($userId);die;
    //     if (isset($res['activity_id'])) {
    //         //活动信息
    //         $param2['activity_id']=$res['activity_id'];
    //         $param2['status']=1;
    //         $activityArr=M('activity')->where($param2)->find();
    //         $curTime=time();
    //         $this->assign('title',$activityArr['title']);
    //         $this->assign('content',$activityArr['content']);
    //         $this->assign('strDatetime',$activityArr['start_datetime']);
    //         $this->assign('endDatetime',$activityArr['end_datetime']);
    //         //活动选项

    //         // $param3['activity_id']=$res['activity_id'];
    //         // $param3['status']=1;
    //         $sql='SELECT count(vor.id) AS num, vao.id,vao.`options_content` FROM vote_activity_options AS vao LEFT JOIN `vote_options_record` AS vor ON vao.id=vor.option_id WHERE vao.status=1 AND vao.`activity_id`='.$res['activity_id'].' GROUP BY vao.id';
    //         $optionsArr=M()->query($sql);
    //         // var_dump($optionsArr);die;
    //         $this->assign('options',$optionsArr);

    //         $this->assign('userid',$userId);

    //         $this->display('index');
           
    //     }else{
    //         $this->error('暂无活动');
    //     }
    // 	// var_dump($res);
    // }

    public function vote(){
        $id=$_REQUEST['optionid'];
        $activityId=$_REQUEST['id'];
        $userId=$_SESSION['USERID'];
        //获取用户投票数
        $auParam['activity_id']=$activityId;
        $auParam['user_id']=$userId;
        $maxNum=M('activity_user')->where($auParam)->getField('num');
        //判断当前的投票数
        $auParam['status']=1;
        $num=M('options_record')->where($auParam)->count();
        if ($num >= $maxNum) {
            $this->error('您的'.$maxNum.'次投票已使用完！');
        }else{
            $param['option_id']=$id;
            $param['user_id']=$userId;
            $param['status']=1;
            $param['activity_id']=$activityId;
            $recordArr=M('options_record')->field('id')->where($param)->find();
            if (!isset($recordArr['id'])) {
                $param['create_datetime']=date('Y-m-d H:i:s',time());
                $res=M('options_record')->data($param)->add();
                if (empty($res)) {
                    $this->error('操作失败！');
                }else{
                    $this->activityInfo();
                }
            }else{
                $this->error('该活动您已经参与投票了！');
            }
        }
    }

    /**
     * 投票统计
     */
    public function countoptions(){
        $activityId=$_GET['id'];
        $res=$this->countBaseOptions($activityId);
        $jsonres=json_encode($res);
        echo $jsonres;
        // echo json_encode($res);
        // $this->display('countoptions');
    }


    /**
     * 登录-提交
     */
    public function submit(){
    	$username=$_POST['username'];
    	$passwd=$_POST['passwd'];
        $this->checkParams(array($username,$passwd));
        //验证用户
        $param['account']=$username;
        $param['passwd']=$passwd;
        $param['status']=1;
        $res=M('user')->field('id,type')->where($param)->find();
        session_start();
        if (isset($res['type']) && $res['type']==1 ) {//管理员
            $_SESSION['USERID']=$res['id'];
            $_SESSION['USERTYPE']=$res['type'];
            $this->admin();
            // header('location:index');
        }else if (isset($res['type']) && $res['type']==0 ) {//用户
            $_SESSION['USERID']=$res['id'];
            $_SESSION['USERTYPE']=$res['type'];
            $this->index();
            // header('location:index');
            // header("location:XXX.php");
        }else{
            $this->error('用户不存在！');
        }
    }

    /**
     * 退出
     */
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        $this->display('login');
    }

    /**
     * 后台管理
     */
    public function admin(){
        $this->assign('userid',$_SESSION['USERID']);
        $this->display('Admin:index');
    }








}