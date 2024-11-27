
<?php 

class BookingController extends BaseController
{
    public $bookingModel;
    public $bookingHistoryModel;
    public $roomModel;

    public function loadModels() {
        $this->bookingModel = new Booking();
        $this->bookingHistoryModel = new BookingHistory();
        $this->roomModel = new Room();
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
        $this->viewApp->requestView('checkout-success.index');
    }
    public function booking_history() {
        $user_id = $_SESSION['user']['user_id'];
        $data = $this->bookingHistoryModel->booking_history_list($user_id);
        $this->viewApp->requestView('history-booking.index', ['data' => $data]);

    }
}