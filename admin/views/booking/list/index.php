<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đặt phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Danh sách đơn đặt phòng</h1>

    <!-- Kiểm tra nếu có thông báo lỗi -->
    <?php if (isset($data['message'])): ?>
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <?php echo $data['message']; ?>
        </div>
    <?php endif; ?>

    <!-- Kiểm tra nếu có dữ liệu -->
    <?php if (isset($data['data']) && count($data['data']) > 0): ?>
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">Mã Đơn</th>
                    <th class="py-2 px-4 border-b">Tên Khách</th>
                    <th class="py-2 px-4 border-b">Phòng</th>
                    <th class="py-2 px-4 border-b">Ngày Đặt</th>
                    <th class="py-2 px-4 border-b">Trạng Thái</th>
                    <th class="py-2 px-4 border-b">Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['data'] as $booking): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo $booking['booking_id']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $booking['customer_name']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $booking['room_id']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo date('d-m-Y', strtotime($booking['check_in'])); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $booking['status']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo number_format($booking['total_price'], 2); ?> VNĐ</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="bg-yellow-500 text-white p-4 rounded mt-4">
            Không có đơn đặt phòng nào.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
