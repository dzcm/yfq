<?php
namespace Rbactivity\Controller;
class IndexController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        if($_SESSION['user_info']){
            $this->assign("rbuser_info",$_SESSION['user_info']);
        }
        $this->display(C('VIEWDIR')['view'].'/index');
    }
   /*  function addPhone(){
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
        } */
        
        function addUser(){
            $info=$_POST;
            $return=['status'=>200,'message'=>"成功"];
            if(!$info['car_number']){
                $return=['status'=>300,'message'=>"车牌号不能为空！"];
                $this->ajaxReturn($return);
            }
            if(!$info['name']){
                $return=['status'=>300,'message'=>"车用户名不能为空！"];
                $this->ajaxReturn($return);
            }
            if(!preg_match("/^1[34578]{1}[0-9]{9}$/",$info['phone'])){
                $return=['status'=>300,'message'=>"手机号输入错误"];
                $this->ajaxReturn($return);
            }
            $user_info=M("user")->where("phone='".$info['phone']."' and type_id=4 and car_number='".$info['car_number']."'")->find();
            if($user_info){
                $_SESSION['user_info']=$user_info;
                $this->ajaxReturn($return);
            }
            $arr=["phone"=>$info['phone'],"car_number"=>$info['car_number'],"real_name"=>$info['name'],"add_time"=>time(),"type_id"=>4];
            $ret=M("user")->add($arr);
            $user_info=M("user")->where("phone='".$info['phone']."' and car_number='".$info['car_number']."'")->find();
            if($user_info){
                $_SESSION['user_info']=$user_info;
                $this->ajaxReturn($return);
            }else{
                $return=['status'=>300,'message'=>"提交失败！"];
                $this->ajaxReturn($return);
            }
        }
}