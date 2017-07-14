<?php
namespace Activity\Controller;
class DirectionsController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $this->share();
        $begin=strtotime("2017-01-28 00:00:00");
        $end=strtotime("2017-02-01 00:00:00");
        $time=time();
        if($time<$begin||$time>$end){
            $this->display("Nonghang/directions1");
        }else{
            $this->display("Nonghang/directions");
        }
       
    }
}