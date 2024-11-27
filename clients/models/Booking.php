<?php 
class Booking extends BaseModel
{
    public $tableName = 'booking';
    public function get_user_bookings($user_id) {
        $query = "SELECT 
            b.booking_id, 
            b.room_id, 
            b.check_in, 
            b.check_out, 
            b.status, 
            b.total_price, 
            b.number_of_guests, 
            b.special_requests,
            r.room_type_id, 
            r.capacity, 
            r.price, 
            r.description AS room_description,
            rt.type_name AS room_type_name,
            GROUP_CONCAT(DISTINCT ri.image_url) AS room_images, 
            GROUP_CONCAT(DISTINCT f.feature_name) AS room_features 
            FROM booking b
            INNER JOIN room r ON b.room_id = r.room_id
            INNER JOIN room_type rt ON r.room_type_id = rt.room_type_id
            LEFT JOIN room_image ri ON r.room_id = ri.room_id
            LEFT JOIN room_feature rf ON r.room_id = rf.room_id
            LEFT JOIN feature f ON rf.feature_id = f.feature_id
            WHERE b.user_id = :user_id
            AND (b.status = 'Confirmed' OR b.status = 'Pending' OR b.status = 'Check-in')
            GROUP BY b.booking_id"; 
    
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
        try {
            $stmt->execute();
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    
        return $bookings;
    }
    
    public function check_in($booking_id) {
        $query = "SELECT 
                    b.booking_id, 
                    b.status AS booking_status,
                    b.check_in, 
                    b.check_out, 
                    r.room_id, 
                    r.availability_status,
                    rt.type_name AS room_type,
                    r.capacity, 
                    r.price, 
                    GROUP_CONCAT(DISTINCT ri.image_url) AS room_images 
                    FROM booking b
                    INNER JOIN room r ON b.room_id = r.room_id
                    INNER JOIN room_type rt ON r.room_type_id = rt.room_type_id
                    LEFT JOIN room_image ri ON r.room_id = ri.room_id
                    WHERE b.booking_id = :booking_id
                    AND b.status = 'Confirmed' 
                    AND r.availability_status = 'Booked'
                    AND DATE(NOW()) >= DATE(b.check_in)"; 
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
    
        try {
            $stmt->execute();
            $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$booking) {
                return "Không thể check-in: Không thỏa mãn điều kiện.";
            }
    
            $updateQuery = "UPDATE booking 
                            SET status = 'Check-in' 
                            WHERE booking_id = :booking_id";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $updateStmt->execute();
    
    
            return "Check-in thành công!";
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage();
        }
    }
    public function check_out($booking_id){
        try{
            
            $historyQuery = "INSERT INTO booking_history (booking_id, action, description, created_at)
                             VALUES (:booking_id, 'Check-out', 'Người dùng đã check-out .', NOW())";
            $historyStmt = $this->conn->prepare($historyQuery);
            $historyStmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $historyStmt->execute();
            // Cập nhạt trạng thái booking
            $updateQuery = "UPDATE booking 
            SET status = 'Check-out' 
            WHERE booking_id = :booking_id";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
            $updateStmt->execute();
            
            return "Check-out thành công!";
        }catch (PDOException $e) {
            return "". $e->getMessage();
        }
    }
    
    

}

?>
