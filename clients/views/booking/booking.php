<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <form 
        class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
        action="<?= $route->getLocateClient('checkout') ?>" 
        method="POST"
    >
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Đặt Phòng Khách Sạn</h2>

        <!-- Ngày nhận phòng -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="checkin-date">Ngày nhận phòng</label>
            <input
                id="checkin-date"
                name="checkin_date"
                type="date"
                required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            />
        </div>

        <!-- Ngày trả phòng -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="checkout-date">Ngày trả phòng</label>
            <input
                id="checkout-date"
                name="checkout_date"
                type="date"
                required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            />
        </div>

        <!-- Loại phòng -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="room-type">Loại phòng</label>
            <select
                id="room-type"
                name="room_id"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            >
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= $room['room_id'] ?>">
                        <?= $room['type_name'] ?> (<?= $room['price'] ?> VND)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Số lượng người -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="guest-count">Số lượng người</label>
            <input
                id="guest-count"
                name="number_of_guests"
                type="number"
                min="1"
                required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            />
        </div>

        <!-- Yêu cầu đặc biệt -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="special-requests">Yêu cầu đặc biệt</label>
            <textarea
                id="special-requests"
                name="special_requests"
                rows="3"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            ></textarea>
        </div>

        <!-- Nút bấm -->
        <div class="flex items-center justify-between">
            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Xác nhận đặt phòng
            </button>
            <a
                href="/"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Hủy
            </a>
        </div>
    </form>
</div>

<?php
// Nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $room_id = $_POST['room_id'];
    $number_of_guests = $_POST['number_of_guests'];
    $special_requests = $_POST['special_requests'];

    // Tạo booking mới
    $stmt = $conn->prepare("INSERT INTO booking (user_id, room_id, check_in, check_out, status, total_price, number_of_guests, special_requests) 
                            VALUES (:user_id, :room_id, :check_in, :check_out, 'Đang xử lý', 0, :number_of_guests, :special_requests)");
    $stmt->execute([
        'user_id' => 1, // Tạm thời là user ID cố định
        'room_id' => $room_id,
        'check_in' => $checkin_date,
        'check_out' => $checkout_date,
        'number_of_guests' => $number_of_guests,
        'special_requests' => $special_requests
    ]);

    // Redirect sau khi đặt phòng thành công
    header("Location: /success.php");
    exit;
}
?>
