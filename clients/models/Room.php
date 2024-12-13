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
    public function countRooms($room_type_id = null) {
        $countQuery = "SELECT COUNT(r.room_id) AS total_rooms
                    FROM room r
                    WHERE r.availability_status = 'Available'";


        if ($room_type_id !== null) {
            $countQuery .= " AND r.room_type_id = :room_type_id";
        }
      
        $countStmt = $this->conn->prepare($countQuery);

        if ($room_type_id !== null) {
            $countStmt->bindValue(':room_type_id', $room_type_id, PDO::PARAM_INT);
        }
        
        if (!$countStmt->execute()) {
            $errorInfo = $countStmt->errorInfo();
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi đếm tổng số phòng.'
            ];
        }
        $countResult = $countStmt->fetch(PDO::FETCH_ASSOC);
        return $countResult['total_rooms'];
    }
    public function getRooms($limit, $check_in_date = null) {
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
                    feature f ON rf.feature_id = f.feature_id";
        
        // Kiểm tra nếu có ngày check_in_date
        if ($check_in_date !== null) {
            // Nếu có check_in_date, lọc phòng trống hoặc phòng đang được đặt và có ngày check_out < check_in_date
            $query .= " WHERE (r.availability_status = 'Available' OR r.room_id IN (
                SELECT room_id 
                FROM booking 
                WHERE room_id = r.room_id
                AND booking_id = (
                    SELECT MAX(booking_id)
                    FROM booking 
                    WHERE room_id = r.room_id
                )
                AND check_out < :check_in_date
            ))";
        } else {
            // Nếu không có check_in_date, chỉ lọc các phòng có trạng thái "Available"
            $query .= " WHERE r.availability_status = 'Available'";
        }
    
        // Thêm giới hạn số lượng kết quả
        $query .= " GROUP BY r.room_id 
                    ORDER BY r.room_id ASC
                    LIMIT :limit";
    
        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        
        // Nếu có ngày check_in_date, ràng buộc tham số ngày
        if ($check_in_date !== null) {
            $stmt->bindValue(':check_in_date', $check_in_date, PDO::PARAM_STR);
        }
        
        // Thực thi câu truy vấn và trả về kết quả
        if (!$stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            error_log('SQL Error: ' . print_r($errorInfo, true)); // Log error for debugging
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách phòng. Vui lòng thử lại sau.'
            ];
        }
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($result)) {
            return [
                'success' => true,
                'message' => 'Không tìm thấy phòng nào.',
                'data' => []
            ];
        }
        
        return $result;
    }
    
    
    
    public function get_rooms_filter($room_type_id, $limit, $check_in_date = null) {
       
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
                WHERE 
                    rt.room_type_id = :room_type_id";
        
        // Kiểm tra nếu có ngày check_in
        if ($check_in_date !== null) {
            // Lọc phòng trống hoặc phòng đang được đặt và có ngày check_out < check_in_date
            $query .= " AND (r.availability_status = 'Available' OR r.room_id IN (
                SELECT room_id 
                FROM booking 
                WHERE room_id = r.room_id
                AND booking_id = (
                    SELECT MAX(booking_id)
                    FROM booking 
                    WHERE room_id = r.room_id
                )
                AND check_out < :check_in_date
            ))";

        } else {
            // Điều kiện phòng còn trống (available)
            $query .= " AND r.availability_status = 'Available'";
        }
    
        // Thêm giới hạn số lượng kết quả
        $query .= " GROUP BY r.room_id 
                    ORDER BY r.room_id ASC
                    LIMIT :limit";
    
        // Chuẩn bị truy vấn
        $stmt = $this->conn->prepare($query);
        
        // Ràng buộc các tham số vào câu truy vấn
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':room_type_id', $room_type_id, PDO::PARAM_INT);
    
        // Nếu có ngày check_in, ràng buộc tham số ngày
        if ($check_in_date !== null) {
            $stmt->bindValue(':check_in_date', $check_in_date, PDO::PARAM_STR);
        }
    
        // Thực thi câu truy vấn và trả về kết quả
        if ($stmt->execute()) {
            $data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $data;
        } else {
            // Xử lý lỗi
            $errorInfo = $stmt->errorInfo();
            error_log("SQL Error: " . $errorInfo[2]);
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách phòng theo loại.'
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
                 WHERE 
                r.availability_status = 'Available'
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 20";
    
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
                     WHERE 
                r.availability_status = 'Available'
                GROUP BY 
                    r.room_id
                ORDER BY 
                    average_rating DESC
                LIMIT 20";
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