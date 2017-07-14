<?php
namespace Common\Model;

use Think\Model;

class ActivityModel extends \Think\Model
{

    protected $tableName = 'game_log';
    /*随机抽奖活动产生随机奖品功能 */
   function activity($type_id){
       $branch_info=M("branch_type")->where(['type_id'=>$type_id])->find();
       if($branch_info['prize_type']==2){
          
           $act_info=M('activity')->where(['act_id'=>$_SESSION['act_info']['act_id'],"status"=>2])->find();
           
       }else{
           $act_info=M('activity')->where(['type_id'=>$type_id,"status"=>2])->find();
       }
       if(!$act_info){
           $return=['status'=>300,'message'=>"未找到对应活动"];
            return $return;
       }
       if($act_info['start_time']>time()||$act_info['end_time']<time()){
           $return=['status'=>300,'message'=>"活动已结束"];
           return $return;
       }
       $my_prize=$this->getMyPrize($act_info,$branch_info);
           if($my_prize['status']!=200){
            return $my_prize;
        }
        /*活动可参与次数  */
        $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"add_date"=>date("Y-m-d")])->find();
        if(!$my_day_info){
            M('user_day_log')->add(['user_id'=>$_SESSION['user_info']['user_id'],"type_id"=>$act_info['type_id'],"add_date"=>date("Y-m-d"),'totle_times'=>$act_info['free_times']]);
            $my_day_info=M('user_day_log')->where(['user_id'=>$_SESSION['user_info']['user_id'],"type_id"=>$act_info['type_id'],"add_date"=>date("Y-m-d")])->find();
        }
        
        if($my_day_info['totle_times']<=$my_day_info['use_times']){
            $times=1;
            if($act_info['pay_times']>0&&$act_info['valid_pay_num']>0&&$act_info['valid_pay_num']>$my_day_info['pay_times']){
                $return=['status'=>400,'message'=>"可参与次数已用完","date"=>['code'=>1,"msg"=>"可通过支付获取次数"]];
                $times=0;
            }
            if($times===0&&$act_info['if_pay_limit_share']=="2"){
                return $return;
            }
            if($act_info['share_times']>0&&$act_info['valid_share_num']>0&&$act_info['valid_share_num']>$my_day_info['share_times']){
                $return=['status'=>400,'message'=>"可参与次数已用完","date"=>['code'=>2,"msg"=>"可通过分享获取次数"]];
                $times=0;
            }
            if($times==0){
                return $return;
            }
            $return=['status'=>400,'message'=>"您今日次数已用完"];
            return $return;
        }
        
        M('prize_day_log')->where('prize_id='.$my_prize['date']['prize_id'].' and add_date="'.date("Y-m-d").'"')->setInc('use_num');
        M('prize')->where('prize_id='.$my_prize['date']['prize_id'])->setInc('use_num');
        
        M('user_day_log')->where('user_log_id='.$my_day_info['user_log_id'])->setInc('use_times');
        M("game_log")->add(['user_id'=>$_SESSION['user_info']['user_id'],"act_id"=>$act_info['act_id'],"type_id"=>$type_id,"prize_id"=>$my_prize['date']['prize_id'],"add_time"=>time()]);
        M('user')->where('user_id='.$_SESSION['user_info']['user_id'])->setInc('totle_money',$my_prize['date']['money']);
        $return=['status'=>200,'message'=>"成功",'date'=>$my_prize['date']];
        return $return;
   }
   /*获取随机中奖信息  */
   function getMyPrize($act_info,$branch_info){
       if($branch_info['prize_type']==2){
           $prize_config_info=M("prize")->where('if_del=1 and type_id='.$branch_info['type_id'])->select();
           $prize_now_info=M('prize_day_log')->where('add_date="'.date("Y-m-d").'" and type_id='.$act_info['type_id'])->select();
       }else{
            $prize_config_info=M("prize")->where('if_del=1 and act_id='.$act_info['act_id'])->select();
            $prize_now_info=M('prize_day_log')->where('add_date="'.date("Y-m-d").'" and act_id='.$act_info['act_id'])->select();
       }
       
       if(!$prize_config_info){
           return ['status'=>300,'message'=>"设置错误"];
       }
       $num=0;
       $prize_ratio=json_decode($act_info['prize_ratio'],true);
       $can_prize_info=[];
       foreach($prize_config_info as $k=>$v){
           if(key_exists($v['prize_id'], $prize_ratio)&&$prize_ratio[$v['prize_id']]>0){
               if($v['if_double']==2){
                 $I_have_prize=M("game_log")->where("prize_id=".$v['prize_id']." and user_id=".$_SESSION['user_info']['user_id'])->find();
                 if($I_have_prize){
                     continue;
                 }
               }
   
               $now_prize=M('prize_day_log')->where('prize_id='.$v['prize_id'].' and add_date="'.date("Y-m-d").'"')->find();
               if(!$now_prize){
                   $v['add_date']=date("Y-m-d");
                    if($branch_info['prize_type']==2&&$v['number']!="-1"){
                        $v['number']=$v['number']-$v['use_num'];
                    }
                   M('prize_day_log')->add($v);
                   if($v['number']>0||$v['number']==-1){
                       $can_prize_info[$v['prize_id']]=$v;
                   }
   
               }else{
                   if($now_prize['number']>$now_prize['use_num'] || $now_prize['number']==-1){
                       $can_prize_info[$v['prize_id']]=$v;
                   }
               }
               if($can_prize_info[$v['prize_id']] && $prize_ratio[$v['prize_id']]>0){
                   $can_prize_info[$v['prize_id']]['min']=$num;
                   $num+=$prize_ratio[$v['prize_id']];
                   $can_prize_info[$v['prize_id']]['max']=$num;
               }
   
           }
       }
       if(!$can_prize_info){
           return ['status'=>500,'message'=>"奖品已经抢完了！"];
       }
       $prize_rand=rand(1, $num);
       foreach($can_prize_info as $key=>$val){
           if($val['min']<$prize_rand&&$prize_rand<=$val['max']){
               $my_prize=$val;
               break;
           }
       }
       return ['status'=>200,'message'=>"成功",'date'=>$my_prize];
   }
}   