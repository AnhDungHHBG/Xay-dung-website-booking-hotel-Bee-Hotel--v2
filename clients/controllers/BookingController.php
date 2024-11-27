
<?php 

class BookingController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $roomModel;
    public $bookingModel;
    public $amenityModel;
    public $bookingHistoryModel;


    public function loadModels() {
        $this->roomModel = new Room();
        $this->bookingModel = new Booking();
        $this->amenityModel = new Amenity();
        $this->bookingHistoryModel = new BookingHistory();
    }

    public function booking_list() {
       
            $user_id = $_SESSION['user']['user_id'];
            $data = $this->bookingModel->get_user_bookings($user_id);
            $this->viewApp->requestView('checkin-checkout.checkin', ['data' => $data]);
        
    }

    public function check_in() {
        $booking_id = $_GET['booking_id'];
        $data = $this->bookingModel->check_in($booking_id);        
    }

    public function check_out() {
        $booking_id = $_GET['booking_id'];
        $room_id = $_GET['room_id'];
        $status = 'Availble';
        $data = $this->bookingModel->check_out($booking_id);
        $this->roomModel->updateStatus($room_id, $status);
        $data1 = [
            'user_id' => $_SESSION['user']['user_id'],
            'room_id' => $room_id,
        ];
        $this->viewApp->requestView('checkout-success.index', ['data' => $data1]);
    }

    public function booking_detail(){
        $room_id = $_GET['room_id'];
        $room = $this->roomModel->getRoomDetail($room_id);
        $amenity = $this -> amenityModel->get_all_amenity();
        
        $data = [
            'room' => $room,
            'amenity' => $amenity
        ];
        $this->viewApp->requestView('room_booking_detail.index', ['data' => $data]);
    }

    public function booking_history() {
        $user_id = $_SESSION['user']['user_id'];
        $data = $this->bookingHistoryModel->booking_history_list($user_id);
        $this->viewApp->requestView('history-booking.index', ['data' => $data]);

    }
}