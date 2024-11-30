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
        // print_r($rooms_booked);
        // die();  
        $this->viewApp->requestView('reviews.list_review', ['data' => $rooms_booked]);


    }
    public function review_post() {
        $data = $this->route->form;
        $this->reviewModel->insertTable($data);
        $this->route->redirectClient('');
    }   
}