<?php 

class SignupController extends BaseController
{
    public $userModel;
    public function loadModels() {
        $this->userModel = new User();
    }

    public function index() {
        $this->viewApp->requestView('signup.signup' );
    }
    public function signup_post(){
        $data = $this->route->form;
        $this->userModel->insertTable($data);
        $this->route->redirectClient('login');
    }
}