<?php 

class HomeController extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('home_page.home_page' );
    }
}