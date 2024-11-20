

<?php 

class RoomDetailController
extends BaseController
{
    public $reviewModel;
    public function loadModels() {
        $this->reviewModel = new Review();
    }
    public function room_detail() {
        $room_id = 1; 
        // $roomDetails = $roomModel->getRoomDetails($room_id =1);
        $reviews = $this->reviewModel->getAllReviews($room_id = 1);

        $averageRatingData = $this->reviewModel->getAverageRating($room_id = 1);
        $averageRating = $averageRatingData['average_rating'] ?? 0; 

        $data = [
            // 'room' => $roomDetails,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
        ];
        $this->viewApp->requestView('room_detail.room_detail',['data' => $data]);
    }
}