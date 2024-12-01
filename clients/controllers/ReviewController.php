<?php 

class ReviewController extends BaseController
{
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $reviewModel;
    public $bookingModel;
    public function loadModels() {
        $this->reviewModel = new Review();
        $this->bookingModel = new Booking();
    }
    public function review_page(){
        $user_id = $_SESSION['user']['user_id'];
        $rooms_booked = $this->bookingModel->get_room_checkout($user_id);
        $this->viewApp->requestView('reviews.list_review', ['data' => $rooms_booked]);
    }
    public function post_reviews() {
        $user_id = $_SESSION['user']['user_id'];
        $room_id_booked = $_GET['room_id'];
        $current_date = date('Y-m-d H:i:s');
        $data = $this->route->form;
        $data->user_id = $user_id;
        $data->room_id = $room_id_booked;
        $data->review_date = $current_date; 
        
        $this->reviewModel->insertTable($data);
        $this->route->redirectClient('review-now');
    }   
}