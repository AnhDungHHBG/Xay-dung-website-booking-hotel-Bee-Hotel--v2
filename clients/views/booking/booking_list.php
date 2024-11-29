<?php
$booking_list = $data;
?>
<div class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center mb-6">Danh Sách Đặt Phòng</h1>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b">Room Code</th>
                        <th class="py-2 px-4 border-b">Room</th>
                        <th class="py-2 px-4 border-b">Check-in</th>
                        <th class="py-2 px-4 border-b">Check-out</th>
                        <th class="py-2 px-4 border-b">Số Khách</th>
                        <th class="py-2 px-4 border-b">Amout</th>
                        <th class="py-2 px-4 border-b">Special Requests</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Detail</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($booking_list as $booking): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b"><?= $booking['booking_id'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $booking['room_description'] ?> (<?= $booking['room_type_name'] ?>)</td>
                        <td class="py-2 px-4 border-b"><?= date('d-m-Y', strtotime($booking['check_in'])) ?></td>
                        <td class="py-2 px-4 border-b"><?= date('d-m-Y', strtotime($booking['check_out'])) ?></td>
                        <td class="py-2 px-4 border-b"><?= $booking['number_of_guests'] ?></td>
                        <td class="py-2 px-4 border-b"><?= number_format($booking['total_price'], 2, ',', '.') ?> VNĐ</td>
                        <td class="py-2 px-4 border-b"><?= $booking['special_requests'] ?></td>
                        <td class="py-2 px-4 border-b"><?= $booking['status'] ?></td>
                        <td class="py-2 px-4 border-b">
                            <?php $images = explode(',', $booking['room_images']); ?>
                            <div class="flex space-x-2">
                                <?php foreach ($images as $image): ?>
                                    <img src="<?= $image ?>" alt="room image" class="w-16 h-16 object-cover rounded">
                                <?php endforeach; ?>
                            </div>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="<?= $route->getLocateClient('booked_detail', ['booking_id' => $booking['booking_id']]) ?>" class="text-blue-500 hover:text-blue-700">Xem Chi Tiết</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</html>
