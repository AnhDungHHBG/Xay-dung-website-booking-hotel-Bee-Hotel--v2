<?php

// Giả sử BaseController đã được định nghĩa ở một nơi khác và cung cấp các phương thức như `viewApp` (ví dụ: load view).
class BookingController extends BaseController {
    public $bookingModel;
    public $userModel;
    public $roomModel;

    // Phương thức load model
    public function loadModels() {
        // Khởi tạo các model liên quan đến booking, user, room
        $this->bookingModel = new Booking();
        $this->userModel = new User();
        $this->roomModel = new Room();
    }

    // Phương thức hiển thị danh sách tất cả đơn đặt phòng
    public function listBookings() {
        // Lấy tất cả các đơn đặt phòng từ model
        $bookings = $this->bookingModel->getAllBookings();
        
        // Gọi view để hiển thị danh sách các đơn đặt phòng, truyền dữ liệu vào view
        $this->viewApp->requestView('booking.list.index', ['data' => $bookings]);
    }

    // Phương thức tạo đơn đặt phòng mới
    public function create($userId, $roomId, $checkIn, $checkOut, $status, $totalPrice, $numberOfGuests, $specialRequests) {
        // Kiểm tra xem phòng có khả dụng hay không
        $room = $this->roomModel->getRoomById($roomId);
        
        if ($room && $room['availability_status']) {
            // Gọi model để tạo đơn đặt phòng mới
            $this->bookingModel->createBooking($userId, $roomId, $checkIn, $checkOut, $status, $totalPrice, $numberOfGuests, $specialRequests);
            // Chuyển hướng về danh sách booking sau khi tạo thành công
            header('Location: /bookings');
            exit;
        } else {
            // Nếu phòng không có sẵn, hiển thị thông báo lỗi
            $this->viewApp->requestView('booking.create.error', ['message' => 'Phòng không còn trống.']);
        }
    }

    // Phương thức cập nhật trạng thái đơn đặt phòng
    public function update($bookingId, $status) {
        // Gọi model để cập nhật trạng thái đơn đặt phòng
        $this->bookingModel->updateBookingStatus($bookingId, $status);
        
        // Chuyển hướng về danh sách booking sau khi cập nhật
        header('Location: /bookings');
        exit;
    }

    // Phương thức xóa đơn đặt phòng
    public function delete($bookingId) {
        // Gọi model để xóa đơn đặt phòng
        $this->bookingModel->deleteBooking($bookingId);
        
        // Chuyển hướng về danh sách booking sau khi xóa
        header('Location: /bookings');
        exit;
    }
}
?>
