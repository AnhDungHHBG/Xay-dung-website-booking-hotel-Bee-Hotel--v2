<?php
$room = $data;
$images = explode(',', $room['images']);
$firstImage = trim($images[0]);
?>
<a href="<?= $route->getLocateClient('room-detail', ['id' => $room['room_id']]) ?>">
    <div
        class="bg-white p-4 rounded-sm shadow-md mb-3 transition-transform duration-500 hover:scale-105 hover:shadow-xl">
        <!-- Hình ảnh phòng -->
        <div class="h-64 bg-gray-200 rounded-lg mb-4 relative"
            style="background-image: url('<?= htmlspecialchars($firstImage) ?>'); background-size: cover; background-position: center;">
            <button class="absolute top-2 right-2 text-[#608BC1] hover:text-[#133E87]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </button>
            <!-- Đánh dấu trang trống ở dưới cùng bên phải hình ảnh -->
            <div class="absolute bottom-2 right-2 flex space-x-1">
                <span class="h-2 w-2 bg-[#CBDCEB] rounded-full"></span>
                <span class="h-2 w-2 bg-[#CBDCEB] rounded-full"></span>
                <span class="h-2 w-2 bg-[#CBDCEB] rounded-full"></span>
                <span class="h-2 w-2 bg-[#CBDCEB] rounded-full"></span>
            </div>
        </div>

        <div class="text-[#133E87] mb-2 text-base">$<?= htmlspecialchars(number_format($room['price'], 2)) ?> USD</div>
        <p class="text-[#133E87] font-semibold text-lg">Room code:
            <?= htmlspecialchars($room['room_id']) ?>-<?= htmlspecialchars($room['room_type']) ?></p>
        <?php 
        $features = explode(',', $room['feature_names']);
        ?>
        <div class="mt-2 text-[#608BC1] text-sm truncate">
            <span>Features: <?= implode(', ', array_map('htmlspecialchars', $features)) ?></span>
        </div>
    </div>
</a>