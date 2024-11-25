<?php
// print_r($data);
// die();
?>
<div class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Sửa Đơn Đặt Phòng</h1>

    <!-- Form Sửa Booking -->
    <form action="<?= $route->getLocateAdmin('booking-post-edit', ['id' => $data['booking_id']]) ?>"  method="POST">
        <div class="mb-4">
            <label for="user_id" class="block text-lg font-medium text-gray-700 mb-2">ID Khách hàng</label>
            <input type="text" name="user_id" id="user_id" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars($data['user_id']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="room_id" class="block text-lg font-medium text-gray-700 mb-2">Mã Phòng</label>
            <input type="text" name="room_id" id="room_id" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars($data['room_id']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="check_in" class="block text-lg font-medium text-gray-700 mb-2">Ngày Check-in</label>
            <input type="text" name="check_in" id="check_in" class="date-picker w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars(date('Y-m-d', strtotime($data['check_in']))) ?>" required>
            </div>
        <div class="mb-4">
            <label for="check_out" class="block text-lg font-medium text-gray-700 mb-2">Ngày Check-out</label>
            <input type="text" name="check_out" id="check_out" class="date-picker w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars(date('Y-m-d', strtotime($data['check_out']))) ?>" required>
            </div>
        <div class="mb-4">
            <label for="status" class="block text-lg font-medium text-gray-700 mb-2">Trạng Thái</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out">
                <option value="Confirmed" <?= $data['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                <option value="Cancelled" <?= $data['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                <option value="Checked-in" <?= $data['status'] === 'Checked-in' ? 'selected' : '' ?>>Checked-in</option>
                <option value="Pending" <?= $data['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="total_price" class="block text-lg font-medium text-gray-700 mb-2">Tổng Tiền</label>
            <input type="number" name="total_price" id="total_price" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars($data['total_price']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="number_of_guests" class="block text-lg font-medium text-gray-700 mb-2">Số Khách</label>
            <input type="number" name="number_of_guests" id="number_of_guests" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out" value="<?= htmlspecialchars($data['number_of_guests']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="special_requests" class="block text-lg font-medium text-gray-700 mb-2">Yêu cầu đặc biệt</label>
            <textarea name="special_requests" id="special_requests" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out"><?= htmlspecialchars($data['special_requests']) ?></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg">Cập nhật</button>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Cập Nhật</button>
        <a href="" class="ml-4 text-gray-700 hover:underline">Quay lại danh sách</a>
    </form>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('#check_in', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'F j, Y',
            minDate: 'today'
        });
        flatpickr('#check_out', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'F j, Y',
            minDate: 'today'
        });
    });
</script>