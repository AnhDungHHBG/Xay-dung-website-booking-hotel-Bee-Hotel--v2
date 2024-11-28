<?php 
class Booking extends BaseModel{
    public $tableName = 'booking';

    public function get_all_bookings_count(){
        $query = 'SELECT COUNT(*) AS booking_count FROM booking;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['booking_count'];  
    }
  
    public function checkin_and_checkout() {
        $today = date('Y-m-d'); 
        $sql = "SELECT r.room_id, r.capacity, r.price, r.availability_status, rt.type_name, b.check_in, b.check_out
                FROM room r
                LEFT JOIN room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN booking b ON r.room_id = b.room_id
                WHERE r.availability_status = 'Booked'
                AND (DATE(b.check_in) = :today OR DATE(b.check_out) = :today)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':today', $today);
        $stmt->execute();
        
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rooms;
    }
    
    public function checkin_or_checkout($filterType) {
        $today = date('Y-m-d');
        
        $filterQuery = "";
        if ($filterType === 'check_in') {
            $filterQuery = "b.check_in = :today";
        } elseif ($filterType === 'check_out') {
            $filterQuery = "b.check_out = :today";
        }
        
        $sql = "SELECT r.room_id, r.capacity, r.price, r.availability_status, rt.type_name, b.check_in, b.check_out
                FROM room r
                LEFT JOIN room_type rt ON r.room_type_id = rt.room_type_id
                LEFT JOIN booking b ON r.room_id = b.room_id
                WHERE r.availability_status = 'Booked'
                AND $filterQuery";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':today', $today);
        
        $stmt->execute();
        
        $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $rooms;
    }

    public function confirm_checkin($booking_id) {
        try {
            $this->conn->beginTransaction();
    
            $updateBookingQuery = "UPDATE booking 
                                   SET status = :status 
                                   WHERE booking_id = :booking_id";
            $stmt = $this->conn->prepare($updateBookingQuery);
            $stmt->bindValue(':status', 'Checked');
            $stmt->bindValue(':booking_id', $booking_id);
            $stmt->execute();
    
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