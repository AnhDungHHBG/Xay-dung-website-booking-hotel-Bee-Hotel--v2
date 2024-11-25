<?php 

class RoomController extends BaseController
{
    public $roomModel;
    public function loadModels() {
        $this->roomModel = new Room();
    }

    public function room_list() {
        $data = $this->roomModel->getRooms();
        // print_r($data);
        // die();
        $this->viewApp->requestView('room_page.index', ['data' => $data]);
    }
   
}