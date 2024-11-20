<?php 
class Review extends BaseModel {
    public $tableName = 'review';

    public function get_reviews($id_room, $limit = 10, $offset = 0) {
        $query = "SELECT r.rating, r.comment, r.review_date, u.name 
                  FROM {$this->tableName} r 
                  JOIN user u ON r.user_id = u.user_id 
                  WHERE r.room_id = :room_id 
                  ORDER BY r.review_date DESC 
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $id_room, PDO::PARAM_INT); 
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllReviews($room_id) {
        $query = "SELECT rating, comment, review_date, u.name 
                  FROM {$this->tableName} r 
                  JOIN user u ON r.user_id = u.user_id 
                  WHERE r.room_id = :room_id 
                  ORDER BY r.review_date DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAverageRating($room_id) {
        $query = "SELECT AVG(rating) AS average_rating 
                  FROM {$this->tableName} 
                  WHERE room_id = :room_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>