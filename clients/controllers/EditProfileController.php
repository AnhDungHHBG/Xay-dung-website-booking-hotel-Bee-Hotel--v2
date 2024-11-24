<?php 

class EditProfileController extends BaseController
{
    public $userModel;
    public function loadModels() {
        $this->userModel = new User();
    }

    public function index() {
        $this->viewApp->requestView('account.edit_profile');
    }
}