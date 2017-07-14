<?php
namespace Zhactivity\Controller;
use Think\Log;
class PrizeController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function myprize(){
        $this->share();
        $user_id=$_SESSION['user_info']['user_id'];
        $user_info=M("user")->where(["user_id"=>$user_id])->find();
        $my_prize_info=M("game_log")->table('yfq_game_log g')->join('yfq_prize p on g.prize_id=p.prize_id')->where("p.level!='0' and g.user_id=".$user_id)->order("g.add_time desc")->select();
        $this->assign("wx_info",$_SESSION['wxinfo'][C("FROM_GZH")]);
        $this->assign("last_money",$user_info['totle_money']-$user_info['use_money']);
        $this->assign("my_prize",$my_prize_info);
        $this->assign("user_id",$user_info);

       $this->display(C($_SESSION['activity_form'])['view'].'/myprize');
    }
}