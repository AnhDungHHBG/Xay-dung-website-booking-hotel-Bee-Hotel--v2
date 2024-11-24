<?php 
class Room extends BaseModel {
    public $tableName = 'room';

    public function getRoomLastest() {
      $query = "SELECT 
                    r.*, 
                    GROUP_CONCAT(ri.image_url) AS image_urls, 
                    GROUP_CONCAT(rf.feature_id) AS feature_ids,
                    GROUP_CONCAT(f.feature_name) AS feature_names,
                    AVG(rv.rating) AS average_rating
                FROM 
                    room r
                LEFT JOIN 
                    room_image ri ON r.room_id = ri.room_id
                LEFT JOIN 
                    room_feature rf ON r.room_id = rf.room_id
                LEFT JOIN 
                    feature f ON rf.feature_id = f.feature_id
                LEFT JOIN 
                    review rv ON r.room_id = rv.room_id
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 10;";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getRoomTop() {
        $query = "SELECT 
                    r.*, 
                    GROUP_CONCAT(DISTINCT ri.image_url) AS image_urls, 
                    GROUP_CONCAT(DISTINCT rf.feature_id) AS feature_ids, 
                    GROUP_CONCAT(DISTINCT f.feature_name) AS feature_names, 
                    AVG(rv.rating) AS average_rating
                FROM 
                    room r
                LEFT JOIN 
                    room_image ri ON r.room_id = ri.room_id
                LEFT JOIN 
                    room_feature rf ON r.room_id = rf.room_id
                LEFT JOIN 
                    feature f ON rf.feature_id = f.feature_id
                LEFT JOIN 
                    review rv ON r.room_id = rv.room_id
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
?>