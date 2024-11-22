<?php
// Các thành phần mặc định của 1 controller phải có. Tất cả các controller đều phải kế thừa lớp này

abstract class BaseController {
    public $route;
    public $viewApp;
    public $auth;

    public function __construct() {
        global $route;
        global $viewApp;
        global $auth;
        $this->route = $route;
        $this->viewApp = $viewApp;
        $this->auth = $auth;
        $this->loadModels();
    }

    public function checkAccess() {
        if (!$this->auth->isLogin) {
            header("Location: /login.php");
            exit();
        }
    }

    abstract public function loadModels();
}
