<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Đặt Phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Danh Sách Đơn Đặt Phòng</h1>
    <a href="/booking-add" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Thêm Đơn Đặt Phòng</a>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border text-left">#</th>
                    <th class="px-4 py-2 border text-left">Tên Khách Hàng</th>
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
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['room_id']); ?></td>
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['check_in']); ?></td>
                            <td class="px-4 py-2 border"><?php echo htmlspecialchars($booking['check_out']); ?></td>
                            <td class="px-4 py-2 border">
                                <span class="<?php echo $booking['status'] === 'Confirmed' ? 'text-green-500' : ($booking['status'] === 'Cancelled' ? 'text-red-500' : 'text-yellow-500'); ?>">
                                    <?php echo htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 border"><?php echo number_format($booking['total_price'], 2) . ' VND'; ?></td>
                            <td class="px-4 py-2 border">
                                <a href="/booking-edit?id=<?php echo $booking['id']; ?>" class="text-blue-500 hover:underline">Sửa</a> |
                                <a href="/booking-delete?id=<?php echo $booking['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
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
</body>
</html>
