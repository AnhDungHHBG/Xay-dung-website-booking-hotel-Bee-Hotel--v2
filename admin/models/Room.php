<?php 
class Room extends BaseModel{
    public $tableName = 'room';

    public function update_status_room($room_id, $status) {
        $query = "UPDATE room SET availability_status = :status WHERE room_id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
    
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            $stmt->bindParam(':id', $room_id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true; 
            } else {
                $errorInfo = $stmt->errorInfo();
                error_log("SQL Error in update_status_room: " . $errorInfo[2]);
                return false; 
            }
        } catch (PDOException $e) {
            error_log("PDOException in update_status_room: " . $e->getMessage());
            return false; 
        }
    }
    

    public function get_rooms($limit = 10, $offset = 0){
        $query = "SELECT 
                    r.room_id,
                    rt.type_name,
                    r.price,
                    r.capacity,
                    r.availability_status,
                    r.description,
                    GROUP_CONCAT(DISTINCT ri.image_url SEPARATOR ', ') AS image_urls,
                    GROUP_CONCAT(DISTINCT f.feature_name SEPARATOR ', ') AS features
                FROM 
                    room r
                JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN 
                    room_image ri ON r.room_id = ri.room_id
                LEFT JOIN 
                    room_feature rf ON r.room_id = rf.room_id
                LEFT JOIN 
                    feature f ON rf.feature_id = f.feature_id
                GROUP BY 
                    r.room_id
                ORDER BY 
                    r.room_id DESC  
                LIMIT :limit OFFSET :offset;";

    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } else {
          
            $errorInfo = $stmt->errorInfo();
            error_log("SQL Error: " . $errorInfo[2]); 
            return [];   
        }
    }

    public function get_room_detail($id) {
        $query = "SELECT 
                        r.room_id,
                        rt.room_type_id,
                        rt.type_name AS room_type,
                        r.capacity,
                        r.price,
                        r.description,
                        r.availability_status,
                        COALESCE(GROUP_CONCAT(DISTINCT ri.image_url SEPARATOR ', '), '') AS images,
                        COALESCE(GROUP_CONCAT(DISTINCT f.feature_id SEPARATOR ', '), '') AS feature_ids
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
    
    public function add_room($data) {
        $this->conn->beginTransaction();
        try {
            // Thêm phòng mới vào bảng room
            $query = "INSERT INTO room (room_type_id, price, capacity, availability_status, description) 
                      VALUES (:room_type_id, :price, :capacity, :availability_status, :description)";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':room_type_id', $data['room_type_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':capacity', $data['capacity'], PDO::PARAM_INT);
            $stmt->bindParam(':availability_status', $data['availability_status']);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            
            $stmt->execute();
            
            // Lấy ID của phòng vừa thêm vào
            $room_id = $this->conn->lastInsertId();
    
            // Thêm ảnh vào bảng room_image
            if (isset($data['images']) && !empty($data['images'])) {
                $images = explode(', ', $data['images']);
                foreach ($images as $image) {
                    $query = "INSERT INTO room_image (room_id, image_url) VALUES (:room_id, :image_url)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                    $stmt->bindParam(':image_url', $image, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
        
            // Thêm tính năng vào bảng room_feature
            if (isset($data['features']) && !empty($data['features'])) {
                foreach ($data['features'] as $feature_id) {
                    $query = "INSERT INTO room_feature (room_id, feature_id) VALUES (:room_id, :feature_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
                    $stmt->bindParam(':feature_id', $feature_id, PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        echo "Tiện ích đã được thêm thành công cho phòng!";
                    } else {
                        echo "Có lỗi xảy ra khi thêm tiện ích!";
                    }
                }
            }
            // Commit transaction
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Thêm phòng thành công.'
            ];
        } catch (Exception $e) {
            // Rollback transaction nếu có lỗi
            $this->conn->rollBack();
            error_log("Error adding room: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi thêm phòng. Vui lòng thử lại.'
            ];
        }
    }
    
    public function update_room($id, $data) {
        $this->conn->beginTransaction();
        try {
            $query = "UPDATE room SET 
                        room_type_id = :room_type_id,
                        price = :price,
                        capacity = :capacity,
                        availability_status = :availability_status,
                        description = :description
                      WHERE room_id = :room_id";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':room_type_id', $data['room_type_id'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':capacity', $data['capacity'], PDO::PARAM_INT);
            $stmt->bindParam(':availability_status', $data['availability_status']);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':room_id', $id, PDO::PARAM_INT);
            
            $stmt->execute();
    
            if (isset($data['images']) && !empty($data['images'])) {
                $query = "DELETE FROM room_image WHERE room_id = :room_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':room_id', $id, PDO::PARAM_INT);
                $stmt->execute();
    
                $images = explode(', ', $data['images']);
                foreach ($images as $image) {
                    $query = "INSERT INTO room_image (room_id, image_url) VALUES (:room_id, :image_url)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':room_id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':image_url', $image, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
    
            if (isset($data['features']) && !empty($data['features'])) {
                $query = "DELETE FROM room_feature WHERE room_id = :room_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':room_id', $id, PDO::PARAM_INT);
                $stmt->execute();

                foreach ($data['features'] as $feature_id) {
                    $query = "INSERT INTO room_feature (room_id, feature_id) VALUES (:room_id, :feature_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':room_id', $id, PDO::PARAM_INT); 
                    $stmt->bindParam(':feature_id', $feature_id, PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        echo "Tiện ích đã được thêm thành công cho phòng!";
                    } else {
                        echo "Có lỗi xảy ra khi thêm tiện ích!";
                    }
                }
            }
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Cập nhật phòng thành công.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Error updating room: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi `xảy` ra khi cập nhật phòng. Vui lòng thử lại.'
            ];
        }
    }
    
    public function delete_room($id_room) {
        $query = "SELECT COUNT(*) as count FROM booking WHERE room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $id_room, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result['count'] > 0) {
            return [
                'success' => false,
                'message' => 'Không thể xóa phòng vì đang có đơn đặt phòng liên quan.'
            ];
        }
    
        $this->conn->beginTransaction();
        try {
            $query = "DELETE FROM room_image WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':room_id', $id_room, PDO::PARAM_INT);
            $stmt->execute();
    
            $query = "DELETE FROM room_feature WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':room_id', $id_room, PDO::PARAM_INT);
            $stmt->execute();
    
            $query = "DELETE FROM room WHERE room_id = :room_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':room_id', $id_room, PDO::PARAM_INT);
            $stmt->execute();
    
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Xóa phòng thành công.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log("Error deleting room: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa phòng. Vui lòng thử lại.'
            ];
        }
    } 
    public function get_all_rooms_count(){
        $query = 'SELECT COUNT(*) AS room_count FROM room;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['room_count'];   
    }
    
    
}


?>