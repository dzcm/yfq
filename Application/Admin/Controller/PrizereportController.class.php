<?php
namespace Admin\Controller;
class PrizereportController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $time=time();
        $start_time=$time-24*60*60*8;
        $type_id=$_GET['type_id']?$_GET['type_id']:2;
        $_time = range($start_time, $time, 24*60*60); 
        $date_arr=[];
        foreach ($_time as $val){
            $date_arr[date("Y-m-d",$val)]=0;
        }
        
        $_time = array_map(create_function('$v', 'return date("Y-m-d", $v);'), $_time);
        $prize_date_info=M("prize_day_log")->where("type_id=".$type_id." and add_date>'".date("Y-m-d",$start_time)."'")->select();
        $prize_use_info['val']=[];
        $prize_name=[];
        $prize_use_info['max_num']=0;
        //今日奖品报表
        $today_prize_info=[];
        $today_prize_info['prize_name']=[];
        $today_prize_info['number']=[];
        $today_prize_info['use_num']=[];
        $today_prize_info['max_num']=0;
        //昨日奖品报表
        $yestday_prize_info=[];
        $yestday_prize_info['prize_name']=[];
        $yestday_prize_info['number']=[];
        $yestday_prize_info['use_num']=[];
        $yestday_prize_info['max_num']=0;
        //单日奖品总个数表
        $prize_day_totle['val']=$date_arr;
        $prize_day_totle['max']=0;
        foreach($prize_date_info as $val){
            /* 今日奖品报表 */
            if($val['add_date']==date("Y-m-d")){
                $today_prize_info['prize_name'][]=$val["prize_name"];
                $today_prize_info['number'][]=$val["number"];
                $today_prize_info['use_num'][]=$val["use_num"];
                if((int)$val['number']>$today_prize_info['max_num']){
                    $today_prize_info['max_num']=(int)$val['number'];
                }
            }
            /*  end*/
            /* 今日奖品报表 */
            if($val['add_date']==date("Y-m-d",$time-60*60*24)){
                $yestday_prize_info['prize_name'][]=$val["prize_name"];
                $yestday_prize_info['number'][]=$val["number"];
                $yestday_prize_info['use_num'][]=$val["use_num"];
                if((int)$val['number']>$yestday_prize_info['max_num']){
                    $yestday_prize_info['max_num']=(int)$val['number'];
                }
            }
            /*  end*/
            $prize_name[$val['prize_id']]=$val["prize_name"];
            if(!$prize_use_info['val'][$val['prize_id']]){
                $prize_use_info['val'][$val['prize_id']]=$date_arr;
            }
            if($val['use_num']>$prize_use_info['max_num']){
                $prize_use_info['max_num']=$val['use_num'];
            }
             $prize_use_info['val'][$val['prize_id']][$val['add_date']]=$val['use_num'];
             $prize_day_totle['val'][$val['add_date']]+=$val['use_num'];
             if( $prize_day_totle['val'][$val['add_date']]>$prize_day_totle['max']){
                 $prize_day_totle['max']= $prize_day_totle['val'][$val['add_date']];
             }
             
        }

        foreach($prize_use_info['val'] as $k=>$v){

            $prize_use_info['prize_name'][$k]=$prize_name[$k];

            $prize_use_info['val'][$k]=array_values($v);
        }
        $prize_use_info["x_title"]=json_encode($_time);
        $prize_use_info['val']=json_encode(array_values($prize_use_info['val']));
        $prize_use_info['prize_name']=json_encode(array_values($prize_use_info['prize_name']));
        
        foreach($today_prize_info as $key=>$val1){
            $today_prize_info[$key]=json_encode($val1);
        }
        foreach($yestday_prize_info as $key2=>$val2){
            $yestday_prize_info[$key2]=json_encode($val2);
        }
        $prize_day_totle['val']=json_encode(array_values($prize_day_totle['val']));
        $prize_day_totle['max']=round($prize_day_totle['max']+10,-1);
        $yestday_prize_info['max_num']=round($yestday_prize_info['max_num']+10,-1);
      $today_prize_info['max_num']=round($today_prize_info['max_num']+10,-1);
      $prize_use_info['max_num']=round($prize_use_info['max_num']+10,-1);
      
      $branch_info=M("branch_type")->select();
      $now_branch=M("branch_type")->where("type_id=".$type_id)->find();
      $this->assign("now_branch",$now_branch);
      $this->assign("branch_info",$branch_info);
        $this->assign("prize_use_info",$prize_use_info);
        $this->assign("today_prize_info",$today_prize_info);
        $this->assign("prize_day_totle",$prize_day_totle);
        $this->assign("yestday_prize_info",$yestday_prize_info);
        $this->assign("date_list",json_encode($_time));
        $this->assign("type_id",$type_id);
       $this->display();
    }
    function gameReport(){
		set_time_limit(0);
		$day=$_GET['type']>0?$_GET['type']:1;
		$day=$day-1;
        $date=date("Y-m-d");
        if(!$date){
            die("日期错误");
        }
        $start_time=strtotime($date." 00:00:00")-60*60*24*$day;
        $end_time=$start_time+60*60*24;
        $game_info=M("game_log")->where("type_id=".$_GET['type_id']." and add_time>".$start_time." and add_time<".$end_time)->select();
        $xlsData=[];
        $prize_infos=[];
        if($game_info){
            foreach($game_info as $key=>$val){
                if($prize_infos[$val['prize_id']]){
                    $prize_info=$prize_infos[$val['prize_id']];;
                }else{
                    $prize_info=M("prize")->where(['prize_id'=>$val['prize_id']])->find();
                    $prize_infos[$val['prize_id']]=$prize_info;
                }
                $xlsData[$key]['money']=$prize_info['money']/100;
                $user_info=M("user")->where(['user_id'=>$val['user_id']])->find();
                $wx_user_info=M('wx_info')->where(["openid"=>$user_info['openid']])->find();
                $xlsData[$key]['nickname']=$wx_user_info['nickname'];
                $xlsData[$key]['add_time']=date("Y-m-d H:i",$val['add_time']);
                $xlsData[$key]['prize_name']=$prize_info['prize_name'];
                $xlsData[$key]['real_name']=$user_info['real_name'];
                $xlsData[$key]['phone']=$user_info['phone'];
                $xlsData[$key]['car_num']=$user_info['car_number'];
               
            }
            
        }
        $excel_mod=D("Excel");
        $xlsCell  = array(
            array('nickname',"昵称"),
            array("real_name","用户名"),
            array("phone","电话"),
            array("prize_name","奖品名"),           
            array('money','金额 '),
            array('add_time',"时间"),
            array("car_num","车牌号"),
        );
        $excel_mod->exportExcel("report",$xlsCell,$xlsData);
    }
}