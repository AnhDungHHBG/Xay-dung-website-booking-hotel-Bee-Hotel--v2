<?php
$room_types = $data['room_types'];
$features = $data['features'];
?>

<div class="bg-gray-100 min-h-screen ">
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Thêm Phòng</h1>
        <form action="<?= $route->getLocateAdmin('room-post-add') ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="room_type_id" class="block text-sm font-medium text-gray-700">Loại Phòng</label>
                <select id="room_type_id" name="room_type_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                    <?php foreach ($room_types as $type): ?>
                        <option value="<?= $type['room_type_id'] ?>">
                            <?= htmlspecialchars($type['type_name']) ?> : <?= htmlspecialchars($type['description']) ?> 
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                <input type="number" id="price" name="price" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="capacity" class="block text-sm font-medium text-gray-700">Sức Chứa</label>
                <input type="number" id="capacity" name="capacity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="availability_status" class="block text-sm font-medium text-gray-700">Tình Trạng</label>
                <select id="availability_status" name="availability_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="Available">Available</option>
                    <option value="Booked">Booked</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Mô Tả</label>
                <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Hình Ảnh</label>
                <div id="imagePreview" class="flex flex-wrap gap-4 mb-4">
                    <p>Chọn hình ảnh mới cho phòng.</p>
                </div>

                <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            </div>
            <div class="mb-4 ">
                <label for="features" class="block text-sm font-medium text-gray-700">Tiện Ích</label>
                <div class="mt-2 gap-4 flex justify-start items-center flex-wrap ">
                    <?php foreach ($features as $feature): ?>
                        <div class="flex items-center">
                            <input type="checkbox" id="feature_<?= $feature['feature_id'] ?>" name="features[]" value="<?= $feature['feature_id'] ?>" class="h-4 w-4 border-gray-300 text-blue-600 focus:ring focus:ring-blue-500">
                            <label for="feature_<?= $feature['feature_id'] ?>" class="ml-2 text-sm text-gray-700"><?= htmlspecialchars($feature['feature_name']) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">Thêm Phòng</button>
            </div>
        </form>
    </div>
</div>
