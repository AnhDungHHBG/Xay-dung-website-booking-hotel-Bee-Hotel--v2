<?php 

class PaymentController extends BaseController {
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $userModel;
    public $roomModel;
    public $bookingModel;
    public $paymentModel;

    public function loadModels() {
        $this->userModel = new User();
        $this->roomModel = new Room();
        $this->paymentModel = new Payment();
        $this->bookingModel = new Booking();
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

        $checkBooking = $this->bookingModel->check_booking($room_id, $user_id);
        if ($checkBooking['result']) {
            $statusRoom = 'Booked';
            $this->roomModel->update_status($room_id,$statusRoom);

            $status = 'Pending';
            $res = $this->bookingModel->create_booking($user_id, $room_id, $array, $status);
            $id = (int) $res;
            
            $statusPayment = 'Pending';
            $this->paymentModel->create_payment($id, $array,$statusPayment);

            $data = $this->bookingModel->getBookingDetail($id);
            $this->viewApp->requestView('result_booking.index', ['data' => $data]);
        }else{
            
            $data = [
                'url' =>  'booking-list',
                'message' => $checkBooking['message'],
            ];
            $this->viewApp->requestView('', ['data' =>$data ] );
        }
        
    }
   
}
?>