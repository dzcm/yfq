<?php
namespace Cdactivity\Controller;
use Think\Log;
class PrizeController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function myjsonprize(){
        $user_id=$_SESSION['user_info']['user_id'];
        $user_info=M("user")->where(["user_id"=>$user_id])->find();
        $my_prize_info=M("game_log")->table('yfq_game_log g')->join('yfq_prize p on g.prize_id=p.prize_id')->where("g.user_id=".$user_id)->order("g.add_time desc")->select();
        $last_money=$user_info['totle_money']-$user_info['use_money'];
       // $this->assign("last_money",$user_info['totle_money']-$user_info['use_money']);
        //$this->assign("my_prize",$my_prize_info);
        $this->assign("user_id",$user_info);
        foreach($my_prize_info as $k=>$v){
            $my_prize_info[$k]['add_time']=date("Y-m-d H:i",$v['add_time']);
        }
        $this->ajaxReturn(['myprize'=>$my_prize_info,'last_money'=>$last_money]);
        //$this->display("Nonghang/myprize");
        
    }
    public function myprize(){
        $this->share();
        $user_id=$_SESSION['user_info']['user_id'];
        $user_info=M("user")->where(["user_id"=>$user_id])->find();
        $my_prize_info=M("game_log")->table('yfq_game_log g')->join('yfq_prize p on g.prize_id=p.prize_id')->where("g.user_id=".$user_id)->order("g.add_time desc")->select();
        $this->assign("wx_info",$_SESSION['appinfo']);
        $this->assign("last_money",$user_info['totle_money']-$user_info['use_money']);
        $this->assign("my_prize",$my_prize_info);
        $this->assign("user_id",$user_info);
       $this->display("Nonghang/myprize");
    }
    public function getRedPacket(){
        $user_id=$_SESSION['user_info']['user_id'];
        $branch_config=C("NONGHANG");
        
        $act_info=M('activity')->where(['type_id'=>$branch_config['type_id'],"status"=>2])->find();
		if($_SESSION['appinfo']['openid']!='opSHVjl6tshpIOV0lXT49Q9wUNr8'){
			if($act_info['start_time']>time()||$act_info['end_time']<time()){
				$return=['status'=>300,'message'=>"活动已结束"];
				$this->ajaxReturn($return);
			}
		}
        $user_info=M("user")->where(["user_id"=>$user_id])->find();
        $last_money=$user_info['totle_money']-$user_info['use_money'];
        if($last_money<100){
            $return=['status'=>300,'message'=>"金额不足1元"];
            $this->ajaxReturn($return);
        }
       $last_money=$last_money>20000?20000:$last_money;
       require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
       $red_chat= \Wechat\Loader::get('Redpack');
       $date=[
           'nonce_str'=>time(),
           'mch_billno'=>'1329774301'.date("Ymd").time(),
           "mch_id"=>'1329774301',
           "wxappid"=>'wx3765d4cae4527a51',
           'send_name'=>'承德农行',
           're_openid'=>$_SESSION['appinfo']['openid'],
           'total_amount'=>$last_money,
           'total_num'=>1,
           'wishing'=>'感谢您参加开宝箱赢红包活动，祝您生活愉快！',
           'client_ip'=>'121.42.186.92',
           'act_name'=>'开宝箱赢红包活动',
           'remark'=>'开宝箱赢红包活动',
       
       ];
     $red_info=$red_chat->sendRedPacket($date);
     $data=$this->xmlToArray($red_info);
     $indata=[
         "user_id"=>$user_id,
         'money'=>$last_money,
         'add_time'=>time(),
         'order_sn'=>$date['mch_billno'],
         "wx_order_sn"=>$data['send_listid'],
         "status"=>$data['result_code']=='SUCCESS'?1:2,
         'message'=>$red_info
         
     ];
     
     if($data['result_code']=='SUCCESS'){
         $ret=M('red_packet_log')->add($indata);
         $ret1=M('user')->where(['user_id'=>$user_id])->setInc("use_money",$last_money);
         if($ret1){
             $return=['status'=>200,'message'=>"发送成功","date"=>['money'=>$last_money]];
             $this->ajaxReturn($return);
         }
         
     }
     Log::write("myredpacket : " . $red_info);
       $return=['status'=>300,'message'=>"提现操作失败"];
       $this->ajaxReturn($return);
    }
    function xmlToArray($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }
}