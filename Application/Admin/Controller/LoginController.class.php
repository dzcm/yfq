<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index()
    {
        if(session("uid")) $this->redirect(C("HOST"));
        else $this->display();
    }
    function login(){
       $info = I("post.");
         $info['password'] = md5($info['password'].C("PASSWORD_SALT"));
        $where['user_name'] = $info['user_name']; 
        $where['user_password'] = $info['password'];
         $user_info=M('admin')->where($where)->find();
        
         if($user_info&&$user_info['status']==1){
             $save['last_login_time']=time();
             $re=M('admin')->where(['uid'=>$user_info['uid']])->save($save);
             if($re)
             {
                 $data['code'] = 200;
                 $data['message'] = "登陆成功";
                 $data['url'] = C("MAIN_URL");//跳转地址
                 session("user_id",$user_info['uid']);
                 session("real_name",$user_info['real_name']);
                 session("user_name",$user_info['user_name']);
                 session("user_password",$user_info['user_password']);
                  
             }
             else
             {
                 $data['code'] = 197;
                 $data['message'] = "用户信息更新是失败无法登录";
             }
         }else{
             $data['code'] = 199;
             $data['message'] = "用户账号密码错误或账号被冻结";
         }
       $data['url']="index";
        $this->ajaxReturn($data);
    }
    public function login_out()
    {
        session(null);
        $data['code'] = 200;
        $data['message'] = "退出成功";
        $this->ajaxReturn($data);
    }
}