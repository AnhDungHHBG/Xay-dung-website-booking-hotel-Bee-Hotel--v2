
<?php 

class BookingController extends BaseController
{
   
    public $bookingModel;
    public $bookingHistoryModel;
    public function loadModels() {
        $this->bookingModel = new Booking();
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
        echo $data;
        die();
    }
    public function booking_history() {
        $user_id = $_SESSION['user']['user_id'];
        $data = $this->bookingHistoryModel->booking_history_list($user_id);
        $this->viewApp->requestView('history-booking.index', ['data' => $data]);

    }
}