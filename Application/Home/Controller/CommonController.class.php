<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    var $mypoenid="";
    public function _initialize(){
         //if(!$_SESSION['appinfo']){
            $this->shouquan();
       // }
        $this->assign("sub",$_SESSION['appinfo']["subscribe"])  ; 
    }
    /*判断当期连接参与活动用户的openid*/
    public function getUseOpenid(){
        $openid=$_SESSION['appinfo']['openid'];
        $myopenid=I("myopenid")?I("myopenid"):"";
        if($openid!=$myopenid){
            $user_info=M("user")->where("openid='".$myopenid."'")->find();
            
            if(!$user_info){
                $myopenid=$_SESSION['appinfo']['openid'];
            }
        }
        $this->mypoenid=$myopenid;
              
    }
    /*微信授权  */
    public function shouquan(){
        
       require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
        $wechat =  \Wechat\Loader::get('Oauth');
		//$url="http://shop.bdpicc.net/H5web/ajax/zhuanfayouxi.html";
        $url="http://dbwxapi.sjzdezhong.com";
       
        /*$dir_url = "/" . $_SERVER['PATH_INFO'] . ".html?cb=0";
        if(!is_null($_SERVER['QUERY_STRING'])){
            $dir_url .= "&" . $_SERVER['QUERY_STRING'];
        }*/
        $dir_url=json_encode(['to_url'=>1]);
        $dir_url = urlencode(urlencode($dir_url));
        $userlist = $wechat->getOauthRedirect($url,$dir_url,"snsapi_userinfo");
		//dump($userlist);
        header("Location:".$userlist); 
    }
}