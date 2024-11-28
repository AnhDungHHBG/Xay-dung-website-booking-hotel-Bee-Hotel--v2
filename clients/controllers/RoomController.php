<?php 

class RoomController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $roomModel;
    public function loadModels() {
        $this->roomModel = new Room();
    }

    public function room_list() {
        $data = $this->roomModel->getRooms();
  
        $this->viewApp->requestView('room_page.index', ['data' => $data]);
    }
    public function room_reverve(){
        $room_id = $_GET['room_id'];
        $status = 'Reverse';
        $this->roomModel->update_status($room_id, $status);
        $this->route->redirectClient('booking-detail', ['room_id' => $room_id]);
    }
   
}