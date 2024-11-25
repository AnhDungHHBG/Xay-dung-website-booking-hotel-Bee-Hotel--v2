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
    
}

?>