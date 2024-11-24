<?php
$room_type = $data; 
?>

<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Sửa Loại Phòng</h1>
        <form action="<?= $route->getLocateAdmin('room-type-post-edit', ['id' => $room_type['room_type_id']]) ?>" method="POST">
            <div class="mb-4">
                <label for="type_name" class="block text-sm font-medium text-gray-700">Tên Loại Phòng</label>
                <input type="text" id="type_name" name="type_name" value="<?= htmlspecialchars($room_type['type_name']) ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Mô Tả</label>
                <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="4"><?= htmlspecialchars($room_type['description']) ?></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>