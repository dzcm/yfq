<?php
namespace Activity\Controller;
class ActivityController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
        if(!$_SESSION['user_info']||!$_SESSION['activity_form']){
            die("信息错误请重新进入首页");
        }

    }
	function getIP()

{

global $ip;

if (getenv("HTTP_CLIENT_IP"))

$ip = getenv("HTTP_CLIENT_IP");

else if(getenv("HTTP_X_FORWARDED_FOR"))

$ip = getenv("HTTP_X_FORWARDED_FOR");

else if(getenv("REMOTE_ADDR"))

$ip = getenv("REMOTE_ADDR");

else $ip = "Unknow";

return $ip;

}
    public function index(){
        $branch_config=C("NONGHANG");
        
        $act_info=M('activity')->where(['type_id'=>$branch_config['type_id'],"status"=>2])->find();
        if(!$act_info){
            $return=['status'=>300,'message'=>"未找到对应活动"];
            $this->ajaxReturn($return);
        }
        if($act_info['start_time']>time()||$act_info['end_time']<time()){
            $return=['status'=>300,'message'=>"活动已结束"];
            $this->ajaxReturn($return);
        }
        $branch =M("branch_type")->where(['type_id'=>$branch_config['type_id']])->find(); 
        $act_mod=D("Activity");
        if($branch['end_type']==1){
            $my_prize=$act_mod->getMyPrize($act_info);
        }
        if($my_prize['status']!=200){
            $this->ajaxReturn($my_prize);
        }
        /*活动可参与次数  */
        $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"type_id"=>$act_info['type_id'],"add_date"=>date("Y-m-d")])->find();
        if(!$my_day_info){
			$ip=$this->getIP();
			
			$cookie_time=strtotime(date("Y-m-d")." 23:59:59")-time();;
			if(cookie('mycookie1')){
			$return=['status'=>500,'message'=>"今日红包已经抢完了！"];
			$this->ajaxReturn($return);
				}else{
					$mycookie=time().rand(100,999);
					cookie('mycookie1',$mycookie,$cookie_time);
					
					}
					/*$cookie_time=3600*24*30;
					if($_COOKIE['mycookie']){
			$mycookie=$_COOKIE['mycookie'];
				}else{
					$mycookie=time().rand(100,999);
					setcookie("mycookie",$mycookie,$cookie_time);
					
					}*/
					
			/*	$cookie_time=3600*24*30;
				if(cookie('mycookie')){
					$mycookie=cookie('mycookie');
				}else{
					$mycookie=time().rand(100,999);
					cookie('mycookie',$mycookie,$cookie_time);
					//setcookie("mycookie",$mycookie,$cookie_time);
					
					}*/
										
            M('user_day_log')->add(['user_id'=>$_SESSION['user_info']['user_id'],"type_id"=>$act_info['type_id'],"add_date"=>date("Y-m-d"),'totle_times'=>$act_info['free_times'],"myip"=>$ip,"cookie_val"=>$mycookie]);
            $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"type_id"=>$act_info['type_id'],"add_date"=>date("Y-m-d")])->find();
        }
		
		$time_day_in=strtotime(date("Y-m-d "."06:50:00"));
		if($my_day_info['use_times']==1 && time()>$time_day_in){
			$return=['status'=>500,'message'=>"今日红包已经抢完了！"];
			$this->ajaxReturn($return);
			}
			
			
       if($my_day_info['totle_times']<=$my_day_info['use_times']){
           if($act_info['pay_times']>0&&$act_info['valid_pay_num']>0&&$act_info['valid_pay_num']>$my_day_info['pay_times']){
               $return=['status'=>400,'message'=>"可参与次数已用完","date"=>['code'=>1,"msg"=>"可通过支付获取次数"]];
               $this->ajaxReturn($return);
           }
           if($act_info['share_times']>0&&$act_info['valid_share_num']>0&&$act_info['valid_share_num']>$my_day_info['share_times']){
               $return=['status'=>400,'message'=>"可参与次数已用完","date"=>['code'=>2,"msg"=>"可通过分享获取次数"]];
               $this->ajaxReturn($return);
           }
           $return=['status'=>300,'message'=>"您今日次数已用完"];
           $this->ajaxReturn($return);
       }
       if($branch['end_type']==1){
           M('prize_day_log')->where('prize_id='.$my_prize['date']['prize_id'].' and add_date="'.date("Y-m-d").'"')->setInc('use_num');
       }
      
       M('user_day_log')->where('user_log_id='.$my_day_info['user_log_id'])->setInc('use_times');
       M("game_log")->add(['user_id'=>$_SESSION['user_info']['user_id'],"act_id"=>$act_info['act_id'],"type_id"=>$branch['type_id'],"prize_id"=>$my_prize['date']['prize_id'],"add_time"=>time()]);
       M('user')->where('user_id='.$_SESSION['user_info']['user_id'])->setInc('totle_money',$my_prize['date']['money']);
       $return=['status'=>200,'message'=>"成功",'date'=>$my_prize['date']];
       $this->ajaxReturn($return);
    }
    function share(){
        $branch_config=C("NONGHANG");
        $user_info = $_SESSION['user_info'];
        $act_info=M('activity')->where(['type_id'=>$branch_config['type_id'],"status"=>2])->find();
        $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"add_date"=>date("Y-m-d")])->find();
        
        M('share_log')->add(['add_time'=>time(),"user_id"=>$user_info['user_id'],"act_id"=>$branch_config['type_id'],"add_date"=>date("Y-m-d")]);
        if($act_info['share_times']>0&&$act_info['valid_share_num']>0&&$act_info['pay_times']>0&&$act_info['valid_share_num']>$my_day_info['share_times']&&$my_day_info["pay_times"]>0){
           
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
        $return=['status'=>200,'message'=>"成功"];
        $this->ajaxReturn($return);
    }
}