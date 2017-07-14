<?php
namespace Admin\Controller;
class IndexController extends CommonController {
    public function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $this->display();
    }
}