<?php
namespace Cdactivity\Controller;
use Think\Controller;
class WxController extends Controller {
    public function getMessage(){
        $rr= require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
        $wechat =  \Wechat\Loader::get('Oauth');
        $info=$wechat->getOauthAccessToken();
        if(!$info){
            die("Please re open the connection！");
        }
        $user_info=$wechat->getOauthUserinfo($info['access_token'],$info['openid']);
      /*   $red_chat= \Wechat\Loader::get('Redpack');
        $red_info=$red_chat->test(); */
        $date=['openid'=>$user_info['openid'],"nickname"=>$user_info["nickname"],"sex"=>$user_info["sex"],"city"=>$user_info["city"],"subscribe"=>$user_info["subscribe"],"headimgurl"=>$user_info['headimgurl'],'country'=>$user_info['country'],"province"=>$user_info['province'],'update_time'=>time()];
        $ifhave=M("wx_info")->where("openid='".$user_info['openid']."'")->find($date);
        if($ifhave){
            M("wx_info")->where("openid='".$user_info['openid']."'")->save($date);
        }else{
            $ret=M("wx_info")->add($date);
        }
        $_SESSION['appinfo']=$user_info;
       
        $state=json_decode($_GET['state'],true);
        header("Location:/Cdactivity/Index?sub=".$state['sub']);
           // $this->redirect("/Activity/Index",['sub'=>$state['sub']]);
    }
}