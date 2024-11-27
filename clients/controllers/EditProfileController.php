<?php 

class EditProfileController extends BaseController
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
        $this->viewApp->requestView('account.edit_profile');
    }
}