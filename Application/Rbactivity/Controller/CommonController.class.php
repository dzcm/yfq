<?php
namespace Rbactivity\Controller;
use Think\Controller;
class CommonController extends Controller {
    var $mypoenid="";
    public function _initialize(){
        /*  if(!$_SESSION['wxinfo'][C("FROM_GZH")]){
            $this->shouquan();
        } */
    }
    /*微信授权  */
    public function shouquan(){
       require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
       $mod= new \Wechat\Loader;
        $myconfig=$mod->myconfig;
       //$myconfig=\Wechat\Loader::myconfig;
       
        $wechat =  \Wechat\Loader::get('Oauth',$myconfig[2]);
        $url="http://zhlh.sjzdezhong.com/2016/getwxinfo.php";
        $dir_url=json_encode(['to_url'=>1,'sub'=>$_GET['sub']==1?1:($_SESSION['sub']?$_SESSION['sub']:0)]);
        $dir_url = urlencode(urlencode($dir_url));
        $userlist = $wechat->getOauthRedirect($url,$dir_url,"snsapi_userinfo");
		//dump($userlist);
        header("Location:".$userlist);
        die;
    }
        function share(){
            $begin=strtotime("2017-01-28 00:00:00");
            $end=strtotime("2017-02-01 00:00:00");
            $time=time();
            if($time<$begin||$time>$end){
                $this->assign("money",50);
            }else{
                $this->assign("money",288);
            }
        require_once SDK_PATH.'dbwxapi/sdk/Wechat/Loader.php';
          $mod= new \Wechat\Loader;
        $myconfig=$mod->myconfig;
        $wechat =  \Wechat\Loader::get('Script',$myconfig[2]);
        $protocol = (!empty($_SERVER[ 'HTTPS' ]) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443) ? "https://" : "http://";
        $murlarray=explode("?", $_SERVER[REQUEST_URI]);
        $url      = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $share=$wechat->getJsSign($url);
        $this->assign("share",$share);
        $url1      = "";
        $this->assign("url",$url1);
        $this->assign("url_img","$protocol$_SERVER[HTTP_HOST]/Public/images/sharepic.jpg");
    }
}