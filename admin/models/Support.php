<?php 
class Support extends BaseModel{
    public $tableName = 'support_ticket';
    public function getAllTickets() {
        $query = "   SELECT s.ticket_id, s.subject, s.message, s.status, s.created_at, u.name 
        FROM {$this->tableName} s 
        JOIN user u ON s.user_id = u.user_id 
        ORDER BY ticket_id DESC";  
        
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } else {
            return [];   
        }
    }
    public function getTicketDetail($id) {
        try {
            $query = "SELECT s.*, u.name AS user_name 
                  FROM {$this->tableName} s 
                  JOIN user u ON s.user_id = u.user_id 
                  WHERE s.ticket_id = :id"; 
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);  
        } catch(Exception $e) {
            $coreApp->debug($e);  
        }
    }
    public function getResponsesByTicketId($ticketId) {
        $query = "SELECT * FROM support_response WHERE ticket_id = :ticket_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ticket_id', $ticketId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function sendResponse($data) {
        $ticketId = $data['ticket_id'];
        $staffId = $data['staff_id'];
        $message = $data['response_message'];
        $query = "INSERT INTO support_response (ticket_id, staff_id, message, created_at) VALUES (:ticket_id, :staff_id, :message, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ticket_id', $ticketId, PDO::PARAM_INT);
        $stmt->bindParam(':staff_id', $staffId, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>