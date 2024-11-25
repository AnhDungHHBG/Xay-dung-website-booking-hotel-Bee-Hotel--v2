<?php 

class DashboardController extends BaseController
{

    public function __construct() {
        parent::__construct(); 
        $this->checkAccess();
    }
    public $roomModel;
    public $bookingModel;
    public $userModel;
    public function loadModels() {
        $this->bookingModel = new Booking();
        $this->roomModel = new Room();
        $this->userModel = new User();
    }

    public function dashboard() {
        $rooms = $this->roomModel->get_all_rooms_count();
        $bookings = $this->bookingModel->get_all_bookings_count();
        $users = $this->userModel->get_all_users_count();


        $data= [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'users' => $users
        ];
        $this->viewApp->requestView('Dashboard.dashboard', ['data' =>$data]);
    }
}