<?php
$rooms = $data['rooms'];
$room_types = $data['room_types'];
$roomsToShow = array_slice($rooms, 0, 18);
?>

<div class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4 text-gray-600">
                <a href="<?= $route->getLocateClient('room-list') ?>" >
                    <span class= "font-medium hover:text-[#608BC1]   <?php echo empty($_GET['room_type_id']) ? 'underline text-[#133E87] underline-offset-4' : ''; ?>" >All</span>
                </a>
                <?php foreach($room_types as $room_type): ?>
                  <a href="<?= $route->getLocateClient('filter-room', ['room_type_id' => $room_type['room_type_id']]) ?>">
                    <span class=" font-medium cursor-pointer hover:text-[#608BC1] <?= isset($_GET['room_type_id']) && $_GET['room_type_id'] == $room_type['room_type_id'] ? 'underline text-[#133E87] underline-offset-4' : '' ?>">
                        <?= htmlspecialchars($room_type['type_name']) ?>
                    </span>         
                     </a>
                <?php endforeach; ?>
            </div>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Filter</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($roomsToShow as $room): ?>
                <?php $viewApp->requestComponents('room_page.components.card', ['data' => $room]); ?>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-6 text-gray-500">
            <button class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Load More</button>
        </div>
    </div>
</div>
