<?php 

class PaymentController extends BaseController {
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $userModel;
    public $bookingModel;
    public $roomModel;

    public function loadModels() {
        $this->userModel = new User();
        $this->bookingModel = new Booking();
        $this->roomModel = new Room();
    }

    public function payment_vnpay() {
        $data = $this->route->form;
        print_r($data);
       
        $data = $_GET['total_payment'];
        $this->viewApp->requestView('payment.index', ['data' => $data]);
    }

    public function payment_onsite() {
        $object = $this->route->form;
        $array = (array) $object;
        $room_id = $_GET['room_id'];
        $user_id = $_SESSION['user']['user_id'];
        $status = 'Pending';
    
        // Chèn booking và lấy ID
        $res = $this->bookingModel->create_booking($user_id, $room_id, $array, $status);
        $id = (int) $res;
    
        // Lấy chi tiết booking
        $data = $this->bookingModel->getBookingDetail($id);
        print_r($data);
        die();
    
        $this->viewApp->requestView('payment.index', ['data' => $data]);
    }
   
}
?>