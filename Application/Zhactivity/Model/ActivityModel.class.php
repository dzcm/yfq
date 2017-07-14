<?php
namespace Activity\Model;

use Think\Model;

class ActivityModel extends \Think\Model
{
    /*获取随机中奖信息  */
 function getMyPrize($act_info){
     $prize_config_info=M("prize")->where('if_del=1 and act_id='.$act_info['act_id'])->select();
     $prize_now_info=M('prize_day_log')->where('add_date="'.date("Y-m-d").'" and act_id='.$act_info['act_id'])->select();
      if(!$prize_config_info){
          return ['status'=>300,'message'=>"设置错误"];
      }
      $num=0;
      $prize_ratio=json_decode($act_info['prize_ratio'],true);
      $can_prize_info=[];
      foreach($prize_config_info as $k=>$v){
          if(key_exists($v['prize_id'], $prize_ratio)&&$prize_ratio[$v['prize_id']]>0){
              
              $now_prize=M('prize_day_log')->where('prize_id='.$v['prize_id'].' and add_date="'.date("Y-m-d").'" and act_id='.$act_info['act_id'])->find();
              if(!$now_prize){
                  $v['add_date']=date("Y-m-d");
                  M('prize_day_log')->add($v);
                  if($v['number']>0){
                      $can_prize_info[$v['prize_id']]=$v;
                  }
                  
              }else{
                  if($now_prize['number']>$now_prize['use_num']){
                      $can_prize_info[$v['prize_id']]=$v;
                  }
              }
              if($can_prize_info[$v['prize_id']]){
                  $can_prize_info[$v['prize_id']]['min']=$num;
                  $num+=$prize_ratio[$v['prize_id']];
                  $can_prize_info[$v['prize_id']]['max']=$num;
              }
              
          }
      }
      if(!$can_prize_info){
          return ['status'=>300,'message'=>"今日红包已经抢完了！"];
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