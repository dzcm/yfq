<?php
namespace Bdactivity\Controller;
class DirectionsController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $this->share();
            $this->display("Nonghang/directions");
       
    }
}