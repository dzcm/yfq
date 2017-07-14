<?php
namespace Admin\Controller;
class BranchController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $info=M('branch_type')->where('status=1')->select();
        $this->assign("info",$info);
        $this->display();
    }
    function addBranch(){
        if(!$_POST){
        $this->display("detail");
        }else{
            $date=[
                'name'=>$_POST['name'],
                "last_money"=>(int)$_POST['last_money']*100,
                'act_type'=>$_POST['act_type']
            ];
            $ret=M('branch_type')->add($date);
            if($ret){
                $this->ajaxReturn(['status'=>200,'message'=>'添加成功']);
            }else{
                $this->ajaxReturn(['status'=>300,'message'=>'添加失败','date'=> $ret]);
            }
        }
    }
    function updateBranch(){
        $date=[
            "last_money"=>(int)$_POST['last_money']*100,
            'update_time'=>time()
        ];
        $ret=M('branch_type')->where("type_id=".$_POST['type_id'])->save($date);
        if($ret){
            $this->ajaxReturn(['status'=>200,'message'=>'修改成功']);
        }else{
            $this->ajaxReturn(['status'=>300,'message'=>'修改失败','date'=> $ret]);
        } 
    }
}