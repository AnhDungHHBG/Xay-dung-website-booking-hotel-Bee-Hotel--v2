<?php

class Booking {
    // Giả sử bạn sử dụng PDO để kết nối với cơ sở dữ liệu
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); // Database kết nối
    }

    // Lấy tất cả các đơn đặt phòng
    public function getAllBookings() {
        $stmt = $this->db->prepare("SELECT * FROM booking");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tạo một đơn đặt phòng mới
    public function createBooking($userId, $roomId, $checkIn, $checkOut, $status, $totalPrice, $numberOfGuests, $specialRequests) {
        $stmt = $this->db->prepare("
            INSERT INTO booking (user_id, room_id, check_in, check_out, status, total_price, number_of_guests, special_requests)
            VALUES (:user_id, :room_id, :check_in, :check_out, :status, :total_price, :number_of_guests, :special_requests)
        ");
        
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':room_id', $roomId);
        $stmt->bindParam(':check_in', $checkIn);
        $stmt->bindParam(':check_out', $checkOut);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':number_of_guests', $numberOfGuests);
        $stmt->bindParam(':special_requests', $specialRequests);
        
        $stmt->execute();
    }

    // Cập nhật trạng thái đơn đặt phòng
    public function updateBookingStatus($bookingId, $status) {
        $stmt = $this->db->prepare("UPDATE booking SET status = :status WHERE booking_id = :booking_id");
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':booking_id', $bookingId);
        $stmt->execute();
    }

    // Xóa một đơn đặt phòng
    public function deleteBooking($bookingId) {
        $stmt = $this->db->prepare("DELETE FROM booking WHERE booking_id = :booking_id");
        $stmt->bindParam(':booking_id', $bookingId);
        $stmt->execute();
    }
}
?>
