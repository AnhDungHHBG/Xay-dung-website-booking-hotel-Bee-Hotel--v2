<?php

class Room {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Database kết nối
    }

    public function getRoomById($roomId) {
        $stmt = $this->db->prepare("SELECT * FROM room WHERE room_id = :room_id");
        $stmt->bindParam(':room_id', $roomId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
