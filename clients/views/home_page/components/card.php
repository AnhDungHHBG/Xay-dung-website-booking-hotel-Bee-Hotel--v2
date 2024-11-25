<?php 

$data = $data['room'] ?? [];  

$images = isset($data['image_urls']) ? explode(',', $data['image_urls']) : [];
$featureNames = isset($data['feature_names']) ? explode(',', $data['feature_names']) : [];

?>
<div class="relative bg-white rounded-lg shadow-lg overflow-hidden group hover:shadow-xl transition-shadow duration-300">
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
    <h3 class="font-semibold text-lg text-gray-800 mb-8 line-clamp-1">
        <?= htmlspecialchars($data['description'] ?? 'Luxurious Suite') ?>
    </h3>


        <!-- Chi tiết -->
        <div class="flex items-start gap-6 mt-4 text-sm text-gray-600">
            <!-- Capacity -->
            <div class="flex items-center gap-1 text-gray-800">
                <i class="fas fa-users text-lg"></i>
                <span class="font-medium">Capacity: <?= htmlspecialchars($data['capacity'] ?? '0') ?></span>
            </div>

            <!-- Rating -->
            <div class="flex items-center gap-1 text-yellow-500">
                <i class="fas fa-star text-lg"></i>
                <span class="font-medium">Rating: <?= htmlspecialchars($data['average_rating'] ?? '0') ?></span>
            </div>

            <!-- Features -->
            <div class="flex-2">
                <div class="flex items-center gap-1 text-gray-800">
                    <i class="fas fa-th-list text-lg"></i>
                    <span class="line-clamp-2 font-medium">Features: <?= !empty($featureNames) ? implode(', ', $featureNames) : 'None' ?></span>
                </div>
            </div>
        </div>  

        <!-- Giá và nút -->
        <div class="mt-4 flex justify-between items-center">
            <span class="text-lg font-bold text-blue-600">
                $<?= number_format($data['price'] ?? 0, 2) ?>
            </span>
            <a href="<?= $route->getLocateClient('room-detail', ['id' => $room['room_id'] ]) ?>"><button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                View Details
            </button></a>
        </div>
    </div>
</div>
