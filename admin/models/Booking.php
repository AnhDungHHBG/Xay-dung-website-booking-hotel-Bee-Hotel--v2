<?php 
class Booking extends BaseModel{
    public $tableName = 'booking';

    public function get_total_bookings_count(){
        $query = 'SELECT COUNT(*) AS booking_count FROM booking;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['booking_count'];  
    }
    public function get_all_bookings_count() {
        $query = 'SELECT COUNT(*) AS booking_count 
                  FROM booking b
                  JOIN room r ON b.room_id = r.room_id
                  WHERE r.availability_status = "Booked"';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['booking_count'];
    }
    
    public function get_all_room_reserve_count() {
        $query = "SELECT COUNT(*) AS reserve_count FROM room WHERE availability_status = 'Reserve';";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['reserve_count'];
    }
    public function get_booking_detail($booking_id) {
        $sql = "SELECT 
                    b.booking_id,
                    b.user_id,
                    u.name AS user_name,
                    u.email AS user_email,
                    u.phone AS user_phone,
                    b.room_id,
                    r.room_type_id,
                    rt.type_name AS room_type_name,
                    r.capacity,
                    r.price AS room_price,
                    b.check_in,
                    b.check_out,
                    b.status AS booking_status,
                    b.total_price,
                    b.number_of_guests,
                    b.special_requests,
                    p.payment_id,
                    p.payment_date,
                    p.amount AS payment_amount,
                    p.payment_method,
                    p.status AS payment_status,
                    rh.history_id,
                    rh.action AS history_action,
                    rh.description AS history_description,
                    rh.created_at AS history_created_at,
                    GROUP_CONCAT(DISTINCT ri.image_url) AS room_images
                FROM 
                    booking b
                LEFT JOIN 
                    user u ON b.user_id = u.user_id
                LEFT JOIN 
                    room r ON b.room_id = r.room_id
                LEFT JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN 
                    payment p ON b.booking_id = p.booking_id
                LEFT JOIN 
                    booking_history rh ON b.booking_id = rh.booking_id
                LEFT JOIN 
                    room_image ri ON r.room_id = ri.room_id
                WHERE 
                    b.booking_id = :booking_id
                GROUP BY 
                    b.booking_id, b.user_id, b.room_id, r.room_type_id, rt.type_name,
                    r.capacity, r.price, b.check_in, b.check_out, b.status, 
                    b.total_price, b.number_of_guests, b.special_requests,
                    p.payment_id, p.payment_date, p.amount, p.payment_method, 
                    p.status, rh.history_id, rh.action, rh.description, rh.created_at";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':booking_id', $booking_id);
        $stmt->execute();
        $bookingDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($bookingDetails && isset($bookingDetails['room_images'])) {
            $bookingDetails['room_images'] = explode(',', $bookingDetails['room_images']);
        }
    
        return $bookingDetails;
    }
    
    public function checkin_and_checkout() {
        $today = date('Y-m-d'); 
        $sql = "SELECT 
                    r.room_id, 
                    r.capacity, 
                    r.price, 
                    r.availability_status, 
                    rt.type_name, 
                    b.booking_id, 
                    b.user_id, 
                    b.check_in, 
                    b.check_out, 
                    b.status AS booking_status, 
                    p.status AS payment_status, 
                    u.name AS user_name, 
                    u.email AS user_email
                FROM 
                    room r
                LEFT JOIN 
                    room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN 
                    booking b ON r.room_id = b.room_id
                LEFT JOIN 
                    payment p ON b.booking_id = p.booking_id
                LEFT JOIN 
                    user u ON b.user_id = u.user_id
                WHERE 
                    r.availability_status = 'Booked'
                    AND (DATE(b.check_in) = :today OR DATE(b.check_out) = :today)
                ORDER BY 
                r.room_id DESC    
                ";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':today', $today);
        $stmt->execute();
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rooms;
    }
    

    public function confirm_checkin($booking_id) {
        try {
            $this->conn->beginTransaction();
            $updatePaymentQuery = "UPDATE payment 
                                   SET status = :status 
                                   WHERE booking_id = :booking_id";
            $stmt = $this->conn->prepare($updatePaymentQuery);
            $stmt->bindValue(':status', 'Success');
            $stmt->bindValue(':booking_id', $booking_id);
            $stmt->execute();
            $this->conn->commit();
            return [
                'success' => true,
                'message' => 'Check-in xác nhận thành công.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Lỗi khi xác nhận check-in: ' . $e->getMessage()
            ];
        }
    }
    public function update_status_booking($booking_id, $status) {
        try {
            $this->conn->beginTransaction();
        
            $updateBookingQuery = "UPDATE booking 
                                   SET status = :status 
                                   WHERE booking_id = :booking_id";
            $stmt = $this->conn->prepare($updateBookingQuery);
            $stmt->bindValue(':status', $status);
            $stmt->bindValue(':booking_id', $booking_id);
            $stmt->execute();
            
            $this->conn->commit();
            
            return [
                'success' => true,
                'message' => 'Update thành công.'
            ];
        } catch (Exception $e) {
            $this->conn->rollBack();
            return [
                'success' => false,
                'message' => 'Update check-in: ' . $e->getMessage()
            ];
        }
    }
    
    public function get_booking($room_id) {
        $query = "SELECT b.booking_id, b.user_id, b.check_in, b.check_out, b.status
                  FROM booking b
                  WHERE b.room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':room_id', $room_id);
        $stmt->execute();
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($booking) {
            return $booking;
        } else {
            return null;
        }
    }

}

?>