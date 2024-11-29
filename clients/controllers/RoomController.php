<?php 

class RoomController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
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
        $this->isLogin();

        $room_id = $_GET['room_id'];
        $statusAvailable = 'Available';
        $checkStatus = $this->roomModel->check_status($room_id, $statusAvailable);

        if($checkStatus['result']){
            $status = 'Reverse';
            $this->roomModel->update_status($room_id, $status);
            $this->route->redirectClient('booking-detail', ['room_id' => $room_id]);
        }else{
            $data = [
                'url' =>'',
                'message' =>  $checkStatus['message']
            ];
            $this->viewApp->requestView('error.index', ['data'=> $data]);
        }
       
    }
   
}