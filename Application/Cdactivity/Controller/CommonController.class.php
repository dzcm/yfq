<?php
namespace Cdactivity\Controller;
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
if(!$this->ismobile()){
    $str .= '<title>抱歉，出错了</title><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"><link rel="stylesheet" type="text/css" href="https://res.wx.qq.com/connect/zh_CN/htmledition/style/wap_err1a9853.css">';
    $str .= '<div class="page_msg"><div class="inner"><span class="msg_icon_wrp"><i class="icon80_smile"></i></span><div class="msg_content">请在手机微信客户端打开链接</div></div></div>';
    echo $str;die;
    
}
         if(!$_SESSION['appinfo']){
             //$_SESSION['appinfo']['openid']='opSHVjl6tshpIOV0lXT49Q9wUNr8';
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

	function ismobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
            return true;
    
        //此条摘自TPM智能切换模板引擎，适合TPM开发
        if(isset ($_SERVER['HTTP_CLIENT']) &&'PhoneClient'==$_SERVER['HTTP_CLIENT'])
            return true;
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], 'wap') ? true : false;
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile'
            );
            //从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
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
        $dir_url=json_encode(['to_url'=>7,'sub'=>$_GET['sub']==1?1:($_SESSION['sub']?$_SESSION['sub']:0)]);
        $dir_url = urlencode(urlencode($dir_url));
        $userlist = $wechat->getOauthRedirect($url,$dir_url,"snsapi_userinfo");
		//dump($userlist);
        header("Location:".$userlist);
        die;
    }
        function share(){
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