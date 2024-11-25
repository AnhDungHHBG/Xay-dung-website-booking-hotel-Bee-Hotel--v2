<?php 
class SupportTicket extends BaseModel
{
    public $tableName = 'support_ticket';

    public function support_send_ticket($user_id, $data){
        // print_r($data);
        // print_r($user_id);
        // die();
        
        // Câu lệnh SQL đã chỉnh sửa
        $query = "INSERT INTO support_ticket (user_id, subject, message, status, created_at)
                  VALUES (:user_id, :subject, :message, :status, NOW())"; // Chắc chắn tạo giá trị cho created_at
    
        $stmt = $this->conn->prepare($query);
        
        // Gắn tham số
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $data['subject'], PDO::PARAM_STR);
        $stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
        return $stmt->rowCount();  // Trả về số dòng đã thay đổi
    }
}
?>
