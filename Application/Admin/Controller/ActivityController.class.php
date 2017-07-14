<?php
namespace Admin\Controller;
class ActivityController extends CommonController {
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
        $info=M("activity")->where('status!=3')->page($page,$rows)->select();
        $num=M("activity")->where('status!=3')->count();
        $pages = ceil($num / $rows); // 总页数
        $this->assign("page", $page);
        $this->assign("count", $num);
        $this->assign("pages", $pages);
        $this->assign("branch",$branch);
        $this->assign("prize_info",$info);
        $this->display();
    }
    function addAct(){
            $branch_info=M('branch_type')->where('status=1')->select();
            $this->assign("branch_info",$branch_info);
            $this->assign("city_codes",C("CITY_CODES"));
            if($_GET['id']){
                $info=M('activity')->where("act_id=".$_GET['id'])->find();
                if($info['city_code']!='all'){
                    $this->assign("my_city_code",explode(",", $info['city_code']));
                    
                }
               
                $this->assign("info",$info);
            }
            $this->display("detail");
        }
    function addActUp(){
        $date=[
            'type_id'=>I('type_id'),
            'act_name'=>I('act_name'),
            'free_times'=>I('free_times')?I('free_times'):0,
            'pay_money'=>I('pay_money')?I('pay_money')*100:0,
            'pay_times'=>I('pay_times')?I('pay_times'):0,
            'valid_pay_num'=>I('valid_pay_num')?I('valid_pay_num'):0,
            'share_times'=>I('share_times')?I('share_times'):0,
            'valid_share_num'=>I('valid_share_num')?I('valid_share_num'):0,
            'start_time'=>I('start_time')?strtotime(I('start_time').' 00:00:00'):0,
            'end_time'=>I('end_time')?strtotime(I('end_time').' 23:59:59'):0,
        ];
        if(I('my_city_code')){
            $date['city_code']=implode(",",I('my_city_code') );
            
        }else{
            $date['city_code']='all';
        }
        if(I('prize_ratio')){
            $date['prize_ratio']=json_encode(I('prize_ratio'));
        }
        if(I('act_id')){
            $ret=M('activity')->where('act_id='.I('act_id'))->save($date);
        }else{
            $ret=M('activity')->add($date);}
            if($ret){
                $this->ajaxReturn(['status'=>200,'message'=>'添加成功']);
            }else{
                $this->ajaxReturn(['status'=>300,'message'=>'添加失败','date'=> $ret]);
            }
        
    }
    function upStatus(){
        $date['status']=I('post.status')==1?2:1;
        $ret=M('activity')->where('act_id='.I('post.act_id'))->save($date);
        if($ret){
            $this->ajaxReturn(['status'=>200,'message'=>'添加成功']);
        }else{
            $this->ajaxReturn(['status'=>300,'message'=>'添加失败','date'=> $ret]);
        }
    }
}