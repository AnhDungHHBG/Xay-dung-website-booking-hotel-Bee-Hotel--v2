<?php
$room = $data;
?>

<div class="w-[350px] rounded-lg overflow-hidden  ">
    <div class="relative bg-gray-100 h-[300px]" >
        <img src="<?= ($room['image_url']) ?>" alt="Room Image" class="w-full h-48 object-cover">
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <i class="far fa-heart"></i>
        </button>
       
    </div>
    <div class="p-4 bg-transparent">
         <div class=" text-gray-600">
            <?= ($room['price']) ?>
        </div>
        <div class="absolute bottom-2 right-2 flex space-x-1">
            <span class="w-2 h-2 bg-white rounded-full"></span>
            <span class="w-2 h-2 bg-white rounded-full"></span>
            <span class="w-2 h-2 bg-white rounded-full"></span>
            <span class="w-2 h-2 bg-white rounded-full"></span>
        </div>
        <h3 class="font-bold text-lg"><?= ($room['type_name']) ?></h3>
        <p class="text-gray-500"><?= ($room['address']) ?></p>
        <div class="flex justify-between text-gray-600 mt-4">
            <div class="flex items-center space-x-1">
                <i class="fas fa-bed"></i>
                <span><?= ($room['features']['bed']) ?></span>
            </div>
            <div class="flex items-center space-x-1">
                <i class="fas fa-bath"></i>
                <span><?= ($room['features']['bath']) ?></span>
            </div>
            <div class="flex items-center space-x-1">
                <i class="fas fa-car"></i>
                <span><?= ($room['features']['car']) ?></span>
            </div>
            <div class="flex items-center space-x-1">
                <i class="fas fa-paw"></i>
                <span><?= ($room['features']['pet']) ?></span>
            </div>
        </div>
    </div>
</div>
