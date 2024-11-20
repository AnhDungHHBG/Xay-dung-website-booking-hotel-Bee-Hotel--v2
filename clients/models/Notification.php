<?php 
class Notification extends BaseModel {
    public $tableName = 'notification';

    public function createNotification($userId, $title, $content) {
        $query = "INSERT INTO {$this->tableName} (user_id, title, content, is_read, created_at) VALUES (:user_id, :title, :content, false, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }
    public function getAllNotifications($userId) {
        $query = "SELECT * FROM {$this->tableName} WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>