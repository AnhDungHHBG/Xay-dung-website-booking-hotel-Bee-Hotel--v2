<?php 
class SupportTicket extends BaseModel
{
    public $tableName = 'support_ticket';

    public function support_send_ticket($user_id, $data){
      
        $query = "INSERT INTO support_ticket (user_id, subject, message, status, created_at)
                  VALUES (:user_id, :subject, :message, :status, NOW())"; 
    
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
        $stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return true; 
    }
}
?>
