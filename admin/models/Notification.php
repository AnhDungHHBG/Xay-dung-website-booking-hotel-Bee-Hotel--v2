<?php 
class Notification extends BaseModel {
    public $tableName = 'notification';

    public function createNotification($title, $content) {
        $query = "INSERT INTO {$this->tableName} (user_id, title, content, is_read, created_at) VALUES (1, :title, :content, false, NOW())"; 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getAllNotifications() {
        $query = "SELECT * FROM {$this->tableName} WHERE user_id = 1 ORDER BY created_at DESC"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>