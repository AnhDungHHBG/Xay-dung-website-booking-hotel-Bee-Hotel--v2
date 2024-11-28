<?php 
class Payment extends BaseModel
{
    public $tableName = 'payment';

    public function confirm_payment($booking_id) {
      
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
}

?>
