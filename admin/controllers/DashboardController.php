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
    public $paymentModel;
    public function loadModels() {
        $this->bookingModel = new Booking();
        $this->roomModel = new Room();
        $this->userModel = new User();
        $this->paymentModel = new Payment();
    }

    public function dashboard() {
        $rooms = $this->roomModel->get_all_rooms_count();
        $bookings = $this->bookingModel->get_all_bookings_count();
        $users = $this->userModel->get_all_users_count();
        $revenue =  $this->paymentModel->get_total_revenue();

        $dataRevenuaMonth = $this->paymentModel->get_bookings_and_revenue_permonth();
        $revenue_per_month = $this->paymentModel->get_revenue_month();

        $data= [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'users' => $users,
            'revenue' => $revenue,
            'data_revenue_mouth' => $dataRevenuaMonth,
            'revenue_per_month' => $revenue_per_month
        ];
        $this->viewApp->requestView('Dashboard.dashboard', ['data' =>$data]);
    }
}