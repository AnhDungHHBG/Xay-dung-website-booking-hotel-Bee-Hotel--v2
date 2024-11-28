<?php 
class Room extends BaseModel {
    public $tableName = 'room';

    public function getRoomDetail($id) {
      
                $query = "SELECT 
                r.room_id,
                rt.room_type_id,
                rt.type_name AS room_type,
                r.capacity,
                r.price,
                r.description,
                r.availability_status,
                COALESCE(GROUP_CONCAT(DISTINCT ri.image_url SEPARATOR ', '), '') AS images,
                COALESCE(GROUP_CONCAT(DISTINCT f.feature_name  SEPARATOR ', '), '') AS feature_names
            FROM 
                room r
            LEFT JOIN 
                room_type rt ON r.room_type_id = rt.room_type_id
            LEFT JOIN 
                room_image ri ON r.room_id = ri.room_id
            LEFT JOIN 
                room_feature rf ON r.room_id = rf.room_id
            LEFT JOIN 
                feature f ON rf.feature_id = f.feature_id
            WHERE 
                r.room_id = :room_id
            GROUP BY 
                r.room_id, rt.room_type_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("SQL Error: " . $errorInfo[2]);
            return [
            'success' => false,
            'message' => 'Có lỗi xảy ra khi lấy thông tin phòng.'
            ];
        }
    }
    public function getRooms($filters = []) {
        $query = "SELECT 
                    r.room_id,
                    rt.room_type_id,
                    rt.type_name AS room_type,
                    r.capacity,
                    r.price,
                    r.description,
                    r.availability_status,
                    COALESCE(GROUP_CONCAT(DISTINCT ri.image_url SEPARATOR ', '), '') AS images,
                    COALESCE(GROUP_CONCAT(DISTINCT f.feature_name SEPARATOR ', '), '') AS feature_names
                FROM 
                    room r
                LEFT JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN 
                    room_image ri ON r.room_id = ri.room_id
                LEFT JOIN 
                    room_feature rf ON r.room_id = rf.room_id
                LEFT JOIN 
                    feature f ON rf.feature_id = f.feature_id
                WHERE 1=1"; 
    
        if (!empty($filters['room_type'])) {
            $query .= " AND rt.type_name LIKE :room_type";
        }
        if (isset($filters['min_price'])) {
            $query .= " AND r.price >= :min_price";
        }
        if (isset($filters['max_price'])) {
            $query .= " AND r.price <= :max_price";
        }

        $query .= " GROUP BY r.room_id ORDER BY r.room_id ASC";
    
        $stmt = $this->conn->prepare($query);
    
        if (!empty($filters['room_type'])) {
            $stmt->bindValue(':room_type', "%" . $filters['room_type'] . "%", PDO::PARAM_STR);
        }
        if (isset($filters['min_price'])) {
            $stmt->bindValue(':min_price', $filters['min_price'], PDO::PARAM_INT);
        }
        if (isset($filters['max_price'])) {
            $stmt->bindValue(':max_price', $filters['max_price'], PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("SQL Error: " . $errorInfo[2]);
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách phòng.'
            ];
        }
    }
    
    public function updateStatus($id, $status) {
       
            $sql = "UPDATE room SET availability_status = :status WHERE room_id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
    }

    public function getRoomLastest() {
        $query = "SELECT 
                    r.*, 
                    rt.type_name AS room_type_name,   
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
                LEFT JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id  
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 10";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRoomTop() {
        $query = "SELECT 
                    r.*, 
                    rt.type_name AS room_type_name,  
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
                LEFT JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id  
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 10";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_status($room_id, $status) {
        try {
            $this->conn->beginTransaction();
            $updatePaymentQuery = "UPDATE room 
                                   SET availability_status = :status 
                                   WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($updatePaymentQuery);
            $stmt->bindValue(':status',$status);
            $stmt->bindValue(':room_id', $room_id);
            $stmt->execute();
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Update status room success.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Eror: ' . $e->getMessage()
            ];
        }
    }

    public function check_status($room_id, $status) {
        try {
            $checkStatusQuery = "SELECT availability_status FROM room WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($checkStatusQuery);
            $stmt->bindValue(':room_id', $room_id);
            $stmt->execute();
    
            // Kiểm tra nếu có phòng với room_id
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row['availability_status'] == $status) {
                    return [
                        'result' => true,
                        'message' => 'Room status matches the provided status.',
                        'status' => $row['availability_status']
                    ];
                } else {
                    return [
                        'result' => false,
                        'message' => 'Room status does not match the provided status.',
                        'status' => $row['availability_status']
                    ];
                }
            } else {
                return [
                    'result' => false,
                    'message' => 'Room not found.'
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
    }
    
}
?>