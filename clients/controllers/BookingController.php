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
            $this->viewApp->requestView('booking.booking_list', ['data' => $data]);
        
    }

    public function booking_detail(){
        $room_id = $_GET['room_id'];
        $check_booking = $this->bookingModel->check_out_date($room_id);
        $room = $this->roomModel->getRoomDetail($room_id);
        $amenity = $this -> amenityModel->get_all_amenity();
        $data = [
            'check_out_date'=> $check_booking,
            'room' => $room,
            'amenity' => $amenity
        ];
        $this->viewApp->requestView('room_booking_detail.index', ['data' => $data]);
    }
    public function booked_detail(){
        $booking_id = $_GET['booking_id'];
        $id = (int) $booking_id;
      
        $data = $this->bookingModel->getBookingDetail($id);
   
        $this->viewApp->requestView('result_booking.index', ['data' => $data]);
    }

    public function booking_history() {
        $user_id = $_SESSION['user']['user_id'];
        $data = $this->bookingHistoryModel->booking_history_list($user_id);
        $this->viewApp->requestView('history-booking.index', ['data' => $data]);

    }
}