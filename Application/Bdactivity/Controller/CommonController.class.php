<?php
namespace Bdactivity\Controller;
use Think\Controller;
class CommonController extends Controller {
    var $mypoenid="";
    public function _initialize(){
		if($this->is_weixin()){

}else{
$str .= '<title>抱歉，出错了</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"><link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css">';
            $str .= '<div class="page_msg"><div class="inner"><span class="msg_icon_wrp"><i class="icon80_smile"></i></span><div class="msg_content">请在微信客户端打开链接</div></div></div>';
            echo $str;


}
         if(!$_SESSION['appinfo']){
            $this->shouquan();
        }
    }
	
	function is_weixin(){ 

if ( strpos($_SERVER['HTTP_USER_AGENT'], 

'MicroMessenger') !== false ) {

        return true;

    }  

        return false;

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
        $url="http://wxapi.duobakeji.com";
       
        $dir_url = "/" . $_SERVER['PATH_INFO'] . ".html?cb=0";
        /*if(!is_null($_SERVER['QUERY_STRING'])){
            $dir_url .= "&" . $_SERVER['QUERY_STRING'];
        }*/
        $dir_url=json_encode(['to_url'=>2,'sub'=>$_GET['sub']==1?1:($_SESSION['sub']?$_SESSION['sub']:0)]);
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
        $wechat =  \Wechat\Loader::get('Script');
        $protocol = (!empty($_SERVER[ 'HTTPS' ]) && $_SERVER[ 'HTTPS' ] !== 'off' || $_SERVER[ 'SERVER_PORT' ] == 443) ? "https://" : "http://";
        $murlarray=explode("?", $_SERVER[REQUEST_URI]);
        $url      = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $share=$wechat->getJsSign($url);
        $this->assign("share",$share);
        $url1      = "";
        $this->assign("url",$url1);
        $this->assign("url_img","$protocol$_SERVER[HTTP_HOST]/Public/images/sharepic.jpg");
    }
   function my_curl_get($url){
       $ch =curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
       curl_setopt($ch, CURLOPT_TIMEOUT, 30);
       $result =curl_exec($ch);
       curl_close($ch);
       return $result;
   }
}