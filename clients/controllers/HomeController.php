<?php 

class HomeController extends BaseController
{
    public $roomModel;

    public function loadModels() {
        $this->roomModel = new Room();
    }
    public function index() {
     
        $lastest = $this->roomModel->getRoomLastest();
        $top = $this->roomModel->getRoomtop();
        $data = [
            "lastest"=> $lastest,
            "top"=> $top,
        ];
        $this->viewApp->requestView('home_page.home_page' , ['data' => $data]);
    }
}
