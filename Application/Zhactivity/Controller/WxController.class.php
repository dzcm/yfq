<?php
namespace Zhactivity\Controller;
use Think\Controller;
class WxController extends Controller {
    public function getMessage(){
       require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
       $mod= new \Wechat\Loader;
        $myconfig=$mod->myconfig;
        $wechat =  $mod::get('Oauth',$myconfig[2]);
        $info=$wechat->getOauthAccessToken();
        if(!$info){
            die("Please re open the connection！");
        }
        $user_info=$wechat->getOauthUserinfo($info['access_token'],$info['openid']);
      /*   $red_chat= \Wechat\Loader::get('Redpack');
        $red_info=$red_chat->test(); */
        $date=['from_gzh'=>'zhonghualianhe','openid'=>$user_info['openid'],"nickname"=>$user_info["nickname"],"sex"=>$user_info["sex"],"city"=>$user_info["city"],"subscribe"=>$user_info["subscribe"],"headimgurl"=>$user_info['headimgurl'],'country'=>$user_info['country'],"province"=>$user_info['province'],'update_time'=>time()];
        $ifhave=M("wx_info")->where("openid='".$user_info['openid']."'")->find($date);
        if($ifhave){
            M("wx_info")->where("openid='".$user_info['openid']."'")->save($date);
        }else{
            $ret=M("wx_info")->add($date);
        }
        $_SESSION['wxinfo']=array(C("FROM_GZH")=>$user_info);
       
        $state=json_decode($_GET['state'],true);
        $_SESSION['sub']=$state['sub'];
        header("Location:/Zhactivity/Index?sub=".$state['sub']);
           // $this->redirect("/Activity/Index",['sub'=>$state['sub']]);
    }
}