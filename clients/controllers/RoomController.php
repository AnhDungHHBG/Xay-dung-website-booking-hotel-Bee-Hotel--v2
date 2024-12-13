<?php 

class RoomController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
    }

    public $roomModel;
    public $roomTypeModel;
    public function loadModels() {
        $this->roomModel = new Room();
        $this->roomTypeModel = new RoomType();
    }
    public function room_list() {
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $check_in_date = $_POST['check_in_date'] ?? $_GET['check_in_date'] ?? null;
        $totalRoom = $this->roomModel->countRooms();
        $rooms = $this->roomModel->getRooms($limit, $check_in_date);
        $room_type = $this->roomTypeModel->allTable();
        $data = [
            'rooms' => $rooms,
            'room_types'=> $room_type,
            'total_rooms' => $totalRoom
        ];
        $this->viewApp->requestView('room_page.index', ['data' => $data]);
    }
    public function room_type_filter(){
        $room_type_id = $_GET['room_type_id'];
        $limit = $_GET['limit'];
        $check_in_date = $_POST['check_in_date'] ?? $_GET['check_in_date'] ?? null;
        $totalRoom = $this->roomModel->countRooms($room_type_id);
        $rooms_filter = $this->roomModel->get_rooms_filter($room_type_id, $limit, $check_in_date);
        if(isset($rooms_filter)){
            $room_type = $this->roomTypeModel->allTable();
            $data = [
                'check_in_date' => $check_in_date,
                'rooms' => $rooms_filter,
                'room_types'=> $room_type,
                'total_rooms' => $totalRoom
            ];
            $this->viewApp->requestView('room_page.index', ['data' => $data]);
        }
    }
   
    public function room_reverve(){
        $this->isLogin();
        $room_id = $_GET['room_id'];
        $status = 'Reverse';
        $this->roomModel->update_status($room_id, $status);
        $this->route->redirectClient('booking-detail', ['room_id' => $room_id]);
    }
    public function room_cancel_reverve(){
        $this->isLogin();
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
}