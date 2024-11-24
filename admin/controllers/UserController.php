<?php 

class UserController extends BaseController
{
    public $userModel;
    public function loadModels() {
        $this->userModel = new User();
    }

    public function user_list() {
        $user = $this->userModel->allTable();
        $this->viewApp->requestView('user.list.list',['user'=>$user]);

    }

    public function delete_user() {
        $id = $_GET['user_id'];
        $this->userModel->removeIdTable($id);
        $this->route->redirectAdmin('users-list');
    }

    public function update_user() {
        $id = $_GET['user_id'];
        $data = $this->userModel->findIdTable($id);
        $this->viewApp->requestView('user.edit.edit', ['users' => $data]);
        $this->route->redirectAdmin('users-list');
    }

    public function post_update_user() {
        $id = $_GET['user_id'];
        $data = $this->route->form;
        $this->userModel->updateIdTable($data, $id);
        $this->route->redirectAdmin('users-list');
    }

    public function create_user() {
        $this->viewApp->requestView('User.add.add');
    }
    
    public function post_create_user() {
        $this->viewApp->requestView('User.add.add');
        $userCreateForm=$this->route->form;
        $this->userModel->insertTable($userCreateForm);
        $this->route->redirectAdmin('users-list');
    }
}