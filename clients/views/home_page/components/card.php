<?php 

$data = $data['room'] ?? [];  

$images = isset($data['image_urls']) ? explode(',', $data['image_urls']) : [];
$featureNames = isset($data['feature_names']) ? explode(',', $data['feature_names']) : [];

?>
<div class="relative bg-white rounded-md shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
    <!-- Hình ảnh -->
    <div class="relative h-48">
        <?php if (!empty($images)): ?>
            <img 
                src="<?= htmlspecialchars($images[0]) ?>" 
                alt="<?= htmlspecialchars($data['description'] ?? 'Room Image') ?>"
                class="w-full h-full object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-105"
            >
        <?php else: ?>
            <div class="w-full h-full bg-gray-200 flex justify-center items-center text-gray-500">
                No Image Available
            </div>
        <?php endif; ?>
        
        <button class="absolute top-3 right-3 p-2 rounded-full bg-white/60 hover:bg-white transition-colors w-[50px] h-[50px]">
            <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
        </button>
    </div>

    <!-- Nội dung -->
    <div class="p-4">
        <h3 class="font-semibold text-lg text-[#133E87] mb-8 line-clamp-1">
            Room code: <?= htmlspecialchars($data['room_id'] ?? 'Luxurious Suite') ?> --  <?= htmlspecialchars($data['room_type_name'] ?? 'Luxurious Suite') ?>
        </h3>

        <!-- Chi tiết -->
        <div class="flex flex-wrap items-start gap-6 mt-6 text-sm text-[#608BC1]">
    <!-- Capacity -->
    <div class="flex items-center gap-2 text-[#133E87]">
        <i class="fas fa-users text-xl"></i>
        <span class="font-semibold">Capacity: <?= htmlspecialchars($data['capacity'] ?? '0') ?></span>
    </div>

    <!-- Rating -->
    <div class="flex items-center gap-2 text-yellow-500">
        <i class="fas fa-star text-xl"></i>
        <span class="font-semibold">Rating: <?= htmlspecialchars($data['average_rating'] ?? '0') ?></span>
    </div>

    <!-- Features -->
    <div class="flex items-center gap-2 text-[#133E87] pr-5 overflow-hidden">
        <i class="fas fa-th-list text-xl"></i>
        <span class="font-semibold  text-ellipsis whitespace-nowrap " title="<?= htmlspecialchars(!empty($featureNames) ? implode(', ', $featureNames) : 'None') ?>">Features: <?= !empty($featureNames) ? implode(', ', $featureNames) : 'None' ?></span>
    </div>

</div>


        <!-- Giá và nút -->
        <div class="mt-4 flex justify-between items-center">
            <span class="text-lg font-bold text-[#133E87]">
                $<?= number_format($data['price'] ?? 0, 2) ?>
            </span>
            <a href="<?= $route->getLocateClient('room-detail', ['id' => $room['room_id'] ]) ?>">
                <button class="px-4 py-2 bg-[#608BC1] text-white rounded-lg hover:bg-[#133E87] transition-colors">
                    View Details
                </button>
            </a>
        </div>
    </div>
</div>
