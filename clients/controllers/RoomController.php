<?php 

class RoomController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }

    public $roomModel;
    public $roomTypeModel;
    public function loadModels() {
        $this->roomModel = new Room();
        $this->roomTypeModel = new RoomType();
    }
    public function room_list() {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $totalRoom = $this->roomModel->countRooms();
        $rooms = $this->roomModel->getRooms($limit);
        $room_type = $this->roomTypeModel->allTable();
        $data = [
            'rooms' => $rooms,
            'room_types'=> $room_type,
            'total_rooms' => $totalRoom
        ];
        $this->viewApp->requestView('room_page.index', ['data' => $data]);
    }
    public function room_reverve(){
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
    public function room_cancel_reverve(){
        $room_id = $_GET['room_id'];
        $statusAvailable = 'Reverse';
        $checkStatus = $this->roomModel->check_status($room_id, $statusAvailable);

        if($checkStatus['result']){
            $status = 'Available';
            $this->roomModel->update_status($room_id, $status);
            $this->route->redirectClient('booking-detail', ['room_id' => $room_id]);
            $this->route->redirectClient('room-list') ;
        }else{
            $data = [
                'url' =>'',
                'message' =>  'some error'
            ];
            $this->viewApp->requestView('error.index', ['data'=> $data]);
        }
    }
    public function room_type_filter(){
        $room_type_id = $_GET['room_type_id'];
        $limit = $_GET['limit'];
        $totalRoom = $this->roomModel->countRooms($room_type_id);
        $rooms_filter = $this->roomModel->get_rooms_filter($room_type_id, $limit);
        if(isset($rooms_filter)){
            $room_type = $this->roomTypeModel->allTable();
            $data = [
                'rooms' => $rooms_filter,
                'room_types'=> $room_type,
                'total_rooms' => $totalRoom
            ];
            $this->viewApp->requestView('room_page.index', ['data' => $data]);
        }
    }
   
}