<?php 

class SupportController extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('support.support' );
    }
}