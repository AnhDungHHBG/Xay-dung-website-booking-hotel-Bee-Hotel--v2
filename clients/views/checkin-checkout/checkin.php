<?php
$bookings = $data;

?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Danh sách Đặt Phòng</h1>

    <?php if ($bookings): ?>
        <div class="flex items-center justify-center">
            
        <?php foreach ($bookings as $booking): ?>
           <div class="w-[500px]">
           <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <!-- Hình ảnh phòng -->
                <?php 
                $room_images = explode(',', $booking['room_images']); 
                ?>
                <?php if (!empty($room_images)): ?>
                    <div class="flex overflow-x-auto gap-4 p-4 bg-gray-100 items-center justify-center">
                        <?php foreach ($room_images as $image): ?>
                            <img src="<?php echo htmlspecialchars(trim($image)); ?>" 
                                 alt="Hình ảnh phòng" 
                                 class="w-40 h-40 object-cover rounded-lg hover:scale-105 transition-transform duration-300">
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-gray-100">
                        <p class="text-gray-400">Chưa có hình ảnh phòng.</p>
                    </div>
                <?php endif; ?>

                <!-- Nội dung thông tin -->
                <div class="p-6">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Phòng: <?php echo htmlspecialchars($booking['room_type_name']); ?></h2>
                    <p class="text-gray-600 mb-4">Mô tả: <?php echo htmlspecialchars($booking['room_description']); ?></p>

                    <!-- Tiện nghi -->
                    <?php 
                    $room_features = explode(',', $booking['room_features']);
                    ?>
                    <p class="text-gray-600 mb-4">
                        <span class="font-medium">Tiện nghi:</span> 
                        <?php echo !empty($room_features) ? htmlspecialchars(implode(', ', $room_features)) : '<span class="text-gray-400">Không có tiện nghi đặc biệt</span>'; ?>
                    </p>

                    <!-- Thông tin khách đặt -->
                    <div class="grid grid-cols-2 gap-4 text-gray-600">
                        <p><span class="font-medium">Ngày nhận phòng:</span> <?php echo date('d-m-Y', strtotime($booking['check_in'])); ?></p>
                        <p><span class="font-medium">Ngày trả phòng:</span> <?php echo date('d-m-Y', strtotime($booking['check_out'])); ?></p>
                        <p><span class="font-medium">Số lượng khách:</span> <?php echo htmlspecialchars($booking['number_of_guests']); ?></p>
                        <p><span class="font-medium">Yêu cầu đặc biệt:</span> <?php echo htmlspecialchars($booking['special_requests'] ?: 'Không có'); ?></p>
                    </div>

                    <!-- Trạng thái -->
                    <p class="text-gray-600 mb-4">
                        <span class="font-medium">Trạng thái:</span> 
                        <span class = "font-bold">
                        <?= htmlspecialchars($booking['status']); ?>

                        </span>
                    </p>

                    <!-- Tổng giá -->
                    <p class="text-gray-800 font-semibold mt-4">
                        Tổng giá: 
                        <span class="text-blue-500"><?php echo number_format($booking['total_price'], 2); ?> VNĐ</span>
                    </p>

                    <!-- Nút Check-in -->
                    <form method="POST" action="<?= $route->getLocateClient('check-in', ['booking_id' => $booking['booking_id']]) ?>" class="mt-6">
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition-colors duration-300 
                                <?php echo ($booking['status'] != 'Confirmed') ? 'opacity-50 cursor-not-allowed' : ''; ?>"
                                <?php echo ($booking['status'] != 'Confirmed') ? 'disabled' : ''; ?>>
                            Check-in
                        </button>
                    </form>
                </div>
            </div>
           </div>
        <?php endforeach; ?>
        </div>
        <?php else: ?>
  <div class="text-center py-10">
    <p class="text-center text-red-500 text-xl font-semibold mb-4">Không tìm thấy thông tin đặt phòng.</p>
    <a href="<?= $route->getLocateClient('') ?>" class="btn bg-blue-500 text-white py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
      Back to home
    </a>
  </div>
<?php endif; ?>


</div>
