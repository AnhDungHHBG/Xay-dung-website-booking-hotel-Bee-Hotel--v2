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
    
    public function create_booking($user_id, $room_id, $data, $status) {
        $query = "INSERT INTO booking (user_id, room_id, check_in, check_out, status, total_price, number_of_guests, special_requests)
        VALUES (:user_id, :room_id, :check_in, :check_out, :status, :total_price, :number_of_guests, :special_requests)";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->bindParam(':check_in', $data['checkin_date'], PDO::PARAM_STR);  
        $stmt->bindParam(':check_out', $data['checkout_date'], PDO::PARAM_STR); 
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':total_price', $data['amount'], PDO::PARAM_STR); 
        $stmt->bindParam(':number_of_guests', $data['number_of_guests'], PDO::PARAM_INT);
        $stmt->bindParam(':special_requests', $data['special_requests'], PDO::PARAM_STR);
    
        try {
            $stmt->execute();
            $lastInsertId = $this->conn->lastInsertId();
            return $lastInsertId;  
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage()); 
            return false;  
        }
    }
    public function getBookingDetail($bookingId) {
        $sql = "SELECT 
                b.booking_id, 
                b.check_in, 
                b.check_out, 
                b.total_price, 
                b.number_of_guests, 
                b.special_requests, 
                r.room_id, 
                r.room_type_id, 
                r.price as room_price, 
                r.description as room_description, 
                rt.type_name as room_type, 
                GROUP_CONCAT(f.feature_name) AS room_features, 
                GROUP_CONCAT(ri.image_url) AS room_images, 
                p.payment_method, 
                p.amount AS payment_amount, 
                p.payment_date,
                u.name as user_name,
                u.email as user_email
            FROM booking b
            JOIN room r ON b.room_id = r.room_id
            JOIN room_type rt ON r.room_type_id = rt.room_type_id
            LEFT JOIN room_feature rf ON r.room_id = rf.room_id
            LEFT JOIN feature f ON rf.feature_id = f.feature_id
            LEFT JOIN room_image ri ON r.room_id = ri.room_id
            LEFT JOIN payment p ON b.booking_id = p.booking_id
            JOIN user u ON b.user_id = u.user_id
            WHERE b.booking_id = :booking_id
            GROUP BY b.booking_id;
        ";
    
        $stmt = $this->conn->prepare($sql);  
        $stmt->bindParam(':booking_id', $bookingId, PDO::PARAM_INT);
        try {
            $stmt->execute();
            $data =  $stmt->fetch(PDO::FETCH_ASSOC); 
            print_r($data);
            die();
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage()); 
            return false;  
        }
    }
    

}

?>
