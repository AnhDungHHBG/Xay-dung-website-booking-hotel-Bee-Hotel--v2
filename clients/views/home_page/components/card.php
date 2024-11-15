<?php
// $isStar = $data['isStar'] ? true : false;

?>

<div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
    <div class="relative h-48">
        <img 
            src="<?= $data['image'] ?? './public/images/default-property.jpg' ?> " 
            alt="<?= $data['title'] ?? 'Property Image' ?>"
            class="w-full h-[280px] object-cover"
        >
        <button class="absolute top-3 right-3 p-2 rounded-full bg-white/50 hover:bg-white transition-colors">
            <i class="far fa-heart text-gray-600 hover:text-red-500"></i>
        </button>
    </div>

    <div class="p-4">
        <h3 class="font-semibold text-lg text-gray-800 mb-1">
            <?= $data['title'] ?? 'Well Furnished Apartment' ?>
        </h3>
        
        <p class="text-gray-500 text-sm">
            <?= $data['address'] ?? '100 Smart Street, LA, USA' ?>
        </p>

        <div class="flex items-center gap-4 mt-3 text-sm text-gray-600">
            <div class="flex items-center gap-1">
                <i class="fas fa-bed"></i>
                <span><?= $data['bedrooms'] ?? '3' ?> Beds</span>
            </div>
            <div class="flex items-center gap-1">
                <i class="fas fa-bath"></i>
                <span><?= $data['bathrooms'] ?? '2' ?> Baths</span>
            </div>
            <div class="flex items-center gap-1">
                <i class="fas fa-ruler-combined"></i>
                <span><?= $data['area'] ?? '1,200' ?> sqft</span>
            </div>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <span class="text-lg font-bold text-blue-600">
                $<?= number_format($data['price'] ?? 1200) ?>/mo
            </span>
            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                View Details
            </button>
        </div>
    </div>

    <!-- <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity"></div> -->
</div>