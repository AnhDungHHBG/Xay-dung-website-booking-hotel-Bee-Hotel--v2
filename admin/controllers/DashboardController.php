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
        $total_bookings = $this->bookingModel->get_total_bookings_count();
        $bookings = $this->bookingModel->get_all_bookings_count();

        $users = $this->userModel->get_all_users_count();
        $revenue = $this->paymentModel->get_total_revenue();
    
        // Lấy dữ liệu bookings và doanh thu theo tháng
        $dataRevenuaMonth = $this->paymentModel->get_bookings_and_revenue_permonth();
        $revenue_per_month = $this->paymentModel->get_revenue_month();
    
        // Điền giá trị 0 vào các tháng thiếu (nếu có)
        $bookings_per_month = $dataRevenuaMonth['bookings_per_month'];
        $revenue_per_month = $dataRevenuaMonth['revenue_per_month'];
        
        // Đảm bảo có đủ 12 tháng dữ liệu (1 đến 12)
        $bookings_per_month = array_pad($bookings_per_month, 12, 0);  
        $revenue_per_month = array_pad($revenue_per_month, 12, 0); 
    
        $months = $dataRevenuaMonth['months'];
    
        $data = [
            'rooms' => $rooms,
            'bookings' => $bookings,
            'total_bookings' => $total_bookings,
            'users' => $users,
            'revenue' => $revenue,
            'data_revenue_mouth' => $dataRevenuaMonth,
            'revenue_per_month' => $revenue_per_month,
            'bookings_per_month' => $bookings_per_month,
            'months' => $months  
        ];    
        $this->viewApp->requestView('Dashboard.dashboard', ['data' =>$data]);
    }
    
}