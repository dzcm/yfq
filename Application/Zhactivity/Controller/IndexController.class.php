<?php
namespace Zhactivity\Controller;
class IndexController extends CommonController {
    public function _initialize()
    {
      //  parent::_initialize();
        $sub=$_GET['sub']==1?1:0;
        $_SESSION['sub']=$sub;
        $time=time();
        $this->share();
        $this->assign("sub",$sub);
    }
    public function index(){
        session("activity_form","ZHONGHUA");
        $type_id=C('ZHONGHUA')['type_id'];
       /* $openid=$_SESSION['wxinfo'][C("FROM_GZH")]['openid'];
        $user_info=M("user")->where("type_id=".$type_id." and openid='".$openid."'")->find();
        if(!$user_info){
            $date=['type_id'=>$type_id,"openid"=>$openid];//$_SESSION['appinfo']['openid']];
            $urse_id=M("user")->add($date);
            $user_info=M("user")->where("type_id=".$type_id." and openid='".$openid."'")->find();
        }
        $_SESSION['user_info']=$user_info;
        $this->assign("user_info",$user_info);*/
        $this->display(C('ZHONGHUA')['view'].'/index');
    }
    function addPhone(){
        $user_info= $_SESSION['user_info'];
        M("user")->where("user_id=".$user_info["user_id"])->save(['phone'=>I("phone"),"update_time"=>time()]);
        $member_info=M("member")->where(['type_id'=>C($_SESSION['activity_form'])['type_id'],"phone"=>I("phone")])->find();
        $order_by=$member_info?"desc":"asc";
        $act_info=M("activity")->where("status=2 and type_id=".C($_SESSION['activity_form'])['type_id'])->order("level ".$order_by)->find();
        $_SESSION['act_info']=$act_info;
        $return=['status'=>200,'message'=>"成功"];
        $this->ajaxReturn($return);
    }
        function myindex(){
            $this->display(C($_SESSION['activity_form'])['view'].'/myindex');
        }
}