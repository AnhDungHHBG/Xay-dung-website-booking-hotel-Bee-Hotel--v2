<?php 

class ReviewController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $reviewModel;
    public function loadModels() {
        $this->reviewModel = new Review();
    }

    public function review_post() {
        $data = $this->route->form;
        $this->reviewModel->insertTable($data);
        $this->route->redirectClient('');
    }   
}