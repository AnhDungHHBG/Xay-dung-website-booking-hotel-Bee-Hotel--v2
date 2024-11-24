<?php 

class RoomController extends BaseController
{
    public $roomModel;
    public function loadModels() {
        $this->roomModel = new Room();
    }

    public function room_list() {
        $data = $this->roomModel->getRooms();
        $this->viewApp->requestView('room.index', ['data' => $data]);
    }
   
}