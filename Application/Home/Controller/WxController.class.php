<?php
namespace Home\Controller;
use Think\Controller;
class WxController extends Controller {
    public function getMessage(){
        $rr= require_once SDK_PATH.'/sdk/Wechat/Loader.php';

       /* $wechat =  \Wechat\Loader::get('Oauth');
        $info=$wechat->getOauthAccessToken();
        if(!$info){
            die("Please re open the connection！");
        }
        $user_chat= \Wechat\Loader::get('User');
        $user_info=$user_chat->getUserInfo($info['openid']);
        dump($user_info);*/
        $red_chat= \Wechat\Loader::get('Redpack');
        $red_info=$red_chat->test();
        dump($red_info);
        $_SESSION['appinfo']=$user_info;
    }
}