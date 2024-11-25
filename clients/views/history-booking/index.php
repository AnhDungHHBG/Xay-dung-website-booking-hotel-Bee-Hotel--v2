<?php
$bookings = $data;
?>

<div class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-600 p-4 text-white text-center">
        <h1 class="text-3xl">Lịch sử đặt phòng</h1>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-6">
        <?php if ($bookings): ?>
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-gray-600">Mã Đặt Phòng</th>
                        <th class="py-3 px-6 text-left text-gray-600">Loại Phòng</th>
                        <th class="py-3 px-6 text-left text-gray-600">Ngày Nhận Phòng</th>
                        <th class="py-3 px-6 text-left text-gray-600">Ngày Trả Phòng</th>
                        <th class="py-3 px-6 text-left text-gray-600">Trạng Thái</th>
                        <th class="py-3 px-6 text-left text-gray-600">Tổng Tiền</th>
                        <th class="py-3 px-6 text-left text-gray-600">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr class="border-t border-gray-200">
                            <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($booking['booking_id']); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($booking['room_type']); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?= date('d/m/Y', strtotime($booking['check_in'])); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?= date('d/m/Y', strtotime($booking['check_out'])); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?= htmlspecialchars($booking['booking_status']); ?></td>
                            <td class="py-4 px-6 text-gray-600"><?= number_format($booking['total_price'], 0, ',', '.'); ?> VNĐ</td>
                            <td class="py-4 px-6 text-gray-600">
                                <a href="booking-details.php?booking_id=<?= htmlspecialchars($booking['booking_id']); ?>" class="text-blue-600 hover:text-blue-800">Xem chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="text-center py-6">
                <p class="text-gray-600">Bạn chưa có lịch sử đặt phòng.</p>
            </div>
        <?php endif; ?>
    </main>

</div>
