

<?php 

class RoomDetailController
extends BaseController
{
    public $reviewModel;
    public $roomModel;
    // public $roomFeature;


    public function loadModels() {
        $this->reviewModel = new Review();
        $this->roomModel = new Room();
        // $this->roomFeature = new Feature();
    }
    public function room_detail() {
        $room_id = $_GET['id']; 
        $roomDetail = $this->roomModel->getRoomDetail($room_id); 
        $reviews = $this->reviewModel->getAllReviews($room_id);
    
        $averageRatingData = $this->reviewModel->getAverageRating($room_id);
        $averageRating = $averageRatingData['average_rating'] ?? 0; 
      
        $data = [
            'room' => $roomDetail,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
        ];
        // print_r($data);
        // die();
        $this->viewApp->requestView('room_detail.room_detail',['data' => $data]);
    }
}