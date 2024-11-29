<?php
$rooms = $data;

// Giới hạn hiển thị tối đa 18 sản phẩm
$roomsToShow = array_slice($rooms, 0, 18);
?>
<div class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4 text-gray-600">
                <span>Apartment</span>
                <span>&gt;</span>
                <span>Flat</span>
                <span>&gt;</span>
                <span>Housing</span>
                <span>&gt;</span>
                <span>USA</span>
            </div>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Filter</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($roomsToShow as $room): ?>
                <?php $viewApp->requestComponents('room_page.components.card', ['data' => $room]); ?>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-6 text-gray-500">Pagination or Load more...</div>
    </div>
</div>
