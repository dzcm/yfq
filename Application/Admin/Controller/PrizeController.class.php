<?php
namespace Admin\Controller;
class PrizeController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $page = (int)I("page") ? (int)I("page") : 1;
        $rows = 10;
        $branch_info=M('branch_type')->where('status=1')->select();
        $branch=[];
        foreach($branch_info as $val){
            $branch[$val['type_id']]=$val['name'];
        }
        $activity_info=M('activity')->select();
        $activity=[];
        foreach($activity_info as $val){
            $activity[$val['act_id']]=$val['act_name'];
        }
        $info=M("prize")->where('if_del=1')->page($page,$rows)->select();
        $num=M("prize")->where('if_del=1')->count();
        $pages = ceil($num / $rows); // 总页数
        $this->assign("page", $page);
        $this->assign("count", $num);
        $this->assign("pages", $pages);
        $this->assign("branch",$branch);
        $this->assign("activity",$activity);
        $this->assign("prize_info",$info);
        $this->display();
    }
    function addPrize(){
        if(!$_POST){
            $branch_info=M('branch_type')->where('status=1')->select();
            $this->assign("branch_info",$branch_info);
            $act_info=M('activity')->where('status!=3')->select();
            $this->assign("act_info",$act_info);
            if($_GET['id']){
                $info=M('prize')->where("prize_id=".$_GET['id'])->find();
                $this->assign("info",$info);
            }
            $this->display("detail");
        }else{
            $date=[
                'prize_name'=>$_POST['prize_name'],
                'level'=>$_POST['level'],
                'update_time'=>time(),
                
            ];
            if($_POST['money']){
               $date['money']=(int)$_POST['money']*100;
            }
            if($_POST['number']){
                $date['number']=(int)$_POST['number'];
            }
            if($_POST['type_id']){
                $date['type_id']=$_POST['type_id'];
            }
            if(I('post.prize_id')){
                $ret=M('prize')->where('prize_id='.I('post.prize_id'))->save($date);
            }else{
                $date["act_id"]=$_POST['act_id'];
            $ret=M('prize')->add($date);}
            if($ret){
                $this->ajaxReturn(['status'=>200,'message'=>'添加成功']);
            }else{
                $this->ajaxReturn(['status'=>300,'message'=>'添加失败','date'=> $ret]);
            }
        }
    }
    function del(){
        $date['if_del']=2;
        $ret=M('prize')->where('prize_id='.I('post.prize_id'))->save($date);
        if($ret){
            $this->ajaxReturn(['status'=>200,'message'=>'添加成功']);
        }else{
            $this->ajaxReturn(['status'=>300,'message'=>'添加失败','date'=> $ret]);
        }
    }
    function getPrize(){
        if(!I('post.act_id')){
            $this->ajaxReturn(['status'=>300,'message'=>'加载失败']);
        }
        $act_info=M("activity")->where("act_id=".I("act_id"))->find();
        
        $branch_inf=M("branch_type")->where('type_id='.$act_info['type_id'])->find();
        if($branch_inf['prize_type']==2){
            $info=M('prize')->where('if_del=1 and type_id='.$branch_inf['type_id'])->select();
            
        }else{
        $info=M('prize')->where('if_del=1 and act_id='.I('post.act_id'))->select();
        }
        $this->ajaxReturn(['status'=>200,'message'=>'添加成功','date'=>$info]);
    }
    function todayPrize(){
        if(!I('get.act_id')){
            die("未找到活动");
        }
        $act_id=I('get.act_id');
        $act_info=M("Activity")->where('status=2 and act_id='.$act_id)->find();
        if(!$act_info){
            die("活动未开启");
        }
        $prize_config_info=M("prize")->where('if_del=1 and act_id='.$act_id)->select();
        $today_prize=[];
        foreach($prize_config_info  as $v){
            $now_prize=M('prize_day_log')->where('prize_id='.$v['prize_id'].' and add_date="'.date("Y-m-d").'" and act_id='.$act_id)->find();
            if($now_prize){
                $today_prize[]=$now_prize;
            }else{
                $v['add_date']=date("Y-m-d");
                $v['update_time']=time();
                M('prize_day_log')->add($v);
                $today_prize[]=$v;
            }
        }
        $this->assign('prize_info',$today_prize);
        $this->display('/Activity/todayprize');
    }
    function uptodayPrize(){
        $prize_info=I("prize");
        foreach($prize_info as $k=>$v){
            $ret=M('prize_day_log')->where('prize_id='.$k.' and add_date="'.date("Y-m-d").'"')->save(['number'=>$v,"update_time"=>time()]);
            if(!$ret){
                $this->ajaxReturn(['status'=>300,'message'=>'修改失败']);
            }
        }
         $this->ajaxReturn(['status'=>200,'message'=>'修改成功']);
    }
}