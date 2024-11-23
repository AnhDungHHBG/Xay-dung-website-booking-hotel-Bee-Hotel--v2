
<div class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Sửa Đơn Đặt Phòng</h1>

    <!-- Form Sửa Booking -->
    <form action="<?= $route->getLocateAdmin('booking-post-edit', ['id' => $data['booking_id']]) ?>" method method="POST" class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">ID Khách Hàng</label>
            <input type="text" name="user_id" id="user_id" class="w-full p-2 border rounded" value="<?php echo $data['user_id']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="room_id" class="block text-sm font-medium text-gray-700">Mã Phòng</label>
            <input type="text" name="room_id" id="room_id" class="w-full p-2 border rounded" value="<?php echo $data['room_id']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="check_in" class="block text-sm font-medium text-gray-700">Ngày Check-in</label>
            <input type="date" name="check_in" id="check_in" class="w-full p-2 border rounded" value="<?php echo $data['check_in']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="check_out" class="block text-sm font-medium text-gray-700">Ngày Check-out</label>
            <input type="date" name="check_out" id="check_out" class="w-full p-2 border rounded" value="<?php echo $data['check_out']; ?>" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Trạng Thái</label>
            <select name="status" id="status" class="w-full p-2 border rounded" required>
                <option value="Pending" <?php echo $data['status'] === 'Pending' ? 'selected' : ''; ?>>Đang chờ</option>
                <option value="Confirmed" <?php echo $data['status'] === 'Confirmed' ? 'selected' : ''; ?>>Đã xác nhận</option>
                <option value="Cancelled" <?php echo $data['status'] === 'Cancelled' ? 'selected' : ''; ?>>Đã hủy</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="total_price" class="block text-sm font-medium text-gray-700">Tổng Tiền</label>
            <input type="number" name="total_price" id="total_price" step="0.01" class="w-full p-2 border rounded" value="<?php echo $data['total_price']; ?>" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập Nhật</button>
        <a href="/booking-list" class="ml-4 text-gray-700 hover:underline">Quay lại danh sách</a>
    </form>
</div>
</div>

<script>
    // Khởi tạo Flatpickr cho các trường ngày
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.date-picker', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'F j, Y',
            minDate: 'today'
        });
    });
</script>