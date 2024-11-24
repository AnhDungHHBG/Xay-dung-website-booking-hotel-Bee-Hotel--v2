<div class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Danh Sách Đơn Đặt Phòng</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">#</th>
                        <th class="px-4 py-2 border text-left">ID Khách hàng</th>
                        <th class="px-4 py-2 border text-left">Mã Phòng</th>
                        <th class="px-4 py-2 border text-left">Ngày Check-in</th>
                        <th class="px-4 py-2 border text-left">Ngày Check-out</th>
                        <th class="px-4 py-2 border text-left">Trạng Thái</th>
                        <th class="px-4 py-2 border text-left">Tổng Tiền</th>
                        <th class="px-4 py-2 border text-left">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)) : ?>
                        <?php foreach ($data as $index => $booking) : ?>
                            <tr class="<?php echo $index % 2 === 0 ? 'bg-gray-50' : ''; ?>">
                                <td class="px-4 py-2 border"><?php echo $index + 1; ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['user_id']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['room_id']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['check_in']); ?></td>
                                <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['check_out']); ?></td>
                                <td class="px-4 py-2 border">
                                    <span class="<?php echo $booking['status'] === 'Confirmed' ? 'text-green-500' : ($booking['status'] === 'Cancelled' ? 'text-red-500' : 'text-yellow-500'); ?>">
                                        <?php echo htmlspecialchars($booking['status']); ?>
                                    </span>
                                </td>
                                <td class="px-4 py-2 border"><?php echo number_format($booking['total_price'], 2) . ' VND'; ?></td>
                                <td class="py-3 px-4 text-sm flex gap-4  items-start">
                                    <a href="<?= $route->getLocateAdmin('booking-edit', ['id' => $booking['booking_id']]) ?>?>" class="text-blue-500 hover:text-blue-700 hover:underline">Chỉnh sửa</a>
                                    <form action="<?= $route->getLocateAdmin('booking-delete', ['id' => $booking['booking_id']]) ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn đặt phòng này?');">
                                        <button type="submit" class="ml-2 text-red-500 hover:text-red-700 hover:underline">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500">Không có đơn đặt phòng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
