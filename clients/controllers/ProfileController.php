<?php 

class ProfileController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $userModel;
    public function loadModels() {
        $this->userModel = new User();
    }

    public function index() {
        $this->viewApp->requestView('account.profile');
    }   
}