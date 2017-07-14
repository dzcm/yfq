<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
    		if(!session("user_id"))
        {
           $this->redirect('/Admin/Login');
        }
    }
}