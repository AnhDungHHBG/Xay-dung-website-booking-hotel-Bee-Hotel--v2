<?php 
class Payment extends BaseModel
{
    public $tableName = 'payment';

    public function create_payment($booking_id, $data, $status) {
      
        $query = "INSERT INTO payment (booking_id, payment_date, amount, payment_method, status)
                  VALUES (:booking_id, NOW(), :amount, :payment_method, :status)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
        $stmt->bindParam(':amount', $data['amount'], PDO::PARAM_STR);
        $stmt->bindParam(':payment_method', $data['payment_method'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return true; 
    }
}

?>
