<?php 

class LoginController extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('login.login' );
    }
}