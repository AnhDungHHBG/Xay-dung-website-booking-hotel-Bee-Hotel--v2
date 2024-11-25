<body class="bg-gray-100">
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Thông tin Đặt Phòng</h1>
        
        <?php if (empty($bookings)): ?>
            <div class="text-center text-gray-500">
                Bạn không có đặt phòng nào sắp đến.
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($bookings as $booking): ?>
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($booking['room_id']); ?> - Phòng <?php echo htmlspecialchars($booking['room_id']); ?></h2>
                        <p class="text-sm text-gray-500">Ngày nhận phòng: <?php echo htmlspecialchars($booking['check_in']); ?></p>
                        <p class="text-sm text-gray-500">Ngày trả phòng: <?php echo htmlspecialchars($booking['check_out']); ?></p>
                        <p class="text-sm text-gray-500">Số khách: <?php echo htmlspecialchars($booking['number_of_guests']); ?></p>
                        <p class="text-sm text-gray-500">Yêu cầu đặc biệt: <?php echo htmlspecialchars($booking['special_requests']); ?></p>
                        
                        <form method="POST" action="checkin.php" class="mt-4">
                            <input type="hidden" name="check_in_booking_id" value="<?php echo $booking['booking_id']; ?>">
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600">Check-in</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>