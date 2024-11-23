<?php

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Database kết nối
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
