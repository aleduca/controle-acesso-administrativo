<?php

namespace app\controllers\admin;

class AdminController extends \app\controllers\ContainerController{

    public function index(){
        $this->view([
            'title' => 'Login'
        ],'admin.login');
    }

}