<?php 
class Review extends BaseModel {
    public $tableName = 'review';

    public function getReviews($limit = 10, $offset = 0) {
        $query = " SELECT 
                        r.review_id,
                        u.name AS user_name,
                        rm.description AS room_description,
                        r.rating,
                        r.comment,
                        r.review_date
                    FROM 
                        review r
                    JOIN 
                        user u ON r.user_id = u.user_id
                    JOIN 
                        room rm ON r.room_id = rm.room_id
                    ORDER BY 
                        r.review_date DESC
                    LIMIT :limit OFFSET :offset
                ";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } else {
            return [];   
        }
    }
}
?>