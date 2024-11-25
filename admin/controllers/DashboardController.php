<?php 

class DashboardController extends BaseController
{

    public function __construct() {
        parent::__construct(); 
        $this->checkAccess();
    }
    public function loadModels() {}

    public function dashboard() {
     
        $this->viewApp->requestView('Dashboard.dashboard');
    }
}