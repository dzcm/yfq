<?php
namespace Activity\Controller;
class IndexController extends CommonController {
    public function _initialize()
    {
       parent::_initialize();
        $sub=$_GET['sub']==1?1:0;
        $_SESSION['sub']=$sub;
        $time=time();
        $this->share();
        $this->assign("sub",$sub);
    }
	
    public function index(){
		//dump($_COOKIE);
		//
		if($_SESSION['appinfo']['openid']=='opSHVjl6tshpIOV0lXT49Q9wUNr8'){
			//var $str='adsfdsa\"asdfasdf';
			//dump($str);
			//dump(str_replace("\""."\'",$str));
			}
        session("activity_form","NONGHANG");
        $type_id=C('NONGHANG')['type_id'];
        $user_info=M("user")->where("type_id=".$type_id." and openid='".$_SESSION['appinfo']['openid']."'")->find();
        if(!$user_info){
            $date=['type_id'=>$type_id,"openid"=>$_SESSION['appinfo']['openid']];
            $urse_id=M("user")->add($date);
            $user_info=M("user")->where("type_id=".$type_id." and openid='".$_SESSION['appinfo']['openid']."'")->find();
        }
        $_SESSION['user_info']=$user_info;
        $this->display(C('NONGHANG')['view'].'/index');
    }
}