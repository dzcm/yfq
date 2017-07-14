<?php
namespace Zhactivity\Controller;
class ActivityController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
        if(!$_SESSION['user_info']||!$_SESSION['activity_form']){
            die("信息错误请重新进入首页");
        }

    }
    function index(){
        
        $type_id=C($_SESSION['activity_form'])['type_id'];
        $mod=D("Common/Activity");
        $ret=$mod->activity($type_id);
       $this->ajaxReturn($ret);
    }
    function share(){
        $branch_config=C($_SESSION['activity_form']);
       
        $user_info = $_SESSION['user_info'];
        $branch_info=M("branch_type")->where(['type_id'=>$branch_config['type_id']])->find();
        if($branch_info['prize_type']==2&&$_SESSION['act_info']){ 
            $act_info=M('activity')->where(['act_id'=>$_SESSION['act_info']['act_id'],"status"=>2])->find();
        }else{
            $act_info=M('activity')->where(['type_id'=>$branch_config['type_id'],"status"=>2])->find();
        }
        $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"add_date"=>date("Y-m-d")])->find();
        
        M('share_log')->add(['add_time'=>time(),"user_id"=>$user_info['user_id'],"act_id"=>$branch_config['type_id'],"add_date"=>date("Y-m-d")]);
        if($act_info['share_times']>0&&$act_info['valid_share_num']>0&&$act_info['valid_share_num']>$my_day_info['share_times']){
            if($act_info['if_pay_limit_share']==1){
                M('user_day_log')->where([
                    'user_id' => $user_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("totle_times");
                M('user_day_log')->where([
                    'user_id' => $user_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("share_times");
                $return=['status'=>200,'message'=>"成功"];
                $this->ajaxReturn($return);
            }
            if($act_info['if_pay_limit_share']==2&&$act_info['pay_times']>0){
                M('user_day_log')->where([
                    'user_id' => $user_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("totle_times");
                M('user_day_log')->where([
                    'user_id' => $user_info['user_id'],
                    "add_date" => date("Y-m-d")
                ])->setInc("share_times");
                $return=['status'=>200,'message'=>"成功"];
                $this->ajaxReturn($return);
            }
            
        }
        $return=['status'=>200,'message'=>"成功"];
        $this->ajaxReturn($return);
    }
}