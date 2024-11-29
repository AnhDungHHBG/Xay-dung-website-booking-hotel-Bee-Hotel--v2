<?php
$room = $data['room'];
$room_types = $data['room_types'];
$room_features = $data['room_features'];
?>

<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Edit Room</h1>
        <form action="<?= $route->getLocateAdmin('room-post-edit', ['id' => $room['room_id']]) ?>" method="POST" enctype="multipart/form-data">
            <!-- Phần Loại Phòng -->
            <div class="mb-4">
                <label for="room_type_id" class="block text-sm font-medium text-gray-700">Room Type</label>
                <select id="room_type_id" name="room_type_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
                    <?php foreach ($room_types as $type): ?>
                        <option value="<?= $type['room_type_id'] ?>" <?= $type['room_type_id'] == $room['room_type_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['type_name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Phần Giá -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" id="price" name="price" value="<?= htmlspecialchars($room['price']) ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>

            <!-- Phần Sức Chứa -->
            <div class="mb-4">
                <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                <input type="number" id="capacity" name="capacity" value="<?= htmlspecialchars($room['capacity']) ?>" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>

            <!-- Phần Tình Trạng -->
            <div class="mb-4">
                <label for="availability_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="availability_status" name="availability_status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
                    <option value="Available" <?= $room['availability_status'] == 'Available' ? 'selected' : '' ?>>Available</option>
                    <option value="Booked" <?= $room['availability_status'] == 'Booked' ? 'selected' : '' ?>>Booked</option>
                </select>
            </div>

            <!-- Phần Mô Tả -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="4" required><?= htmlspecialchars($room['description']) ?></textarea>
            </div>

            <!-- Phần Hình Ảnh -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image</label>

                <div id="imagePreview" class="flex flex-wrap gap-4 mb-4">
                    <?php if (!empty($room['images'])): ?>
                        <?php $images = explode(', ', $room['images']); ?>
                        <?php foreach ($images as $image): ?>
                            <div class="relative">
                                <img src="<?= htmlspecialchars($image) ?>" alt="Room Image" class="w-32 h-32 object-cover rounded-lg">
                                <button type="button" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-full" onclick="removeImage('<?= htmlspecialchars($image) ?>')">
                                    Delete
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Image.</p>
                    <?php endif; ?>
                </div>

                <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500">
            </div>

            <!-- Phần Tiện Ích -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Feature</label>
                <div class="space-y-2">
                    <?php 
                    if (is_array($room_features)) :
                        $feature_ids = explode(',', $room['feature_ids']);
                        foreach ($room_features as $feature):
                    ?>
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="feature_<?= $feature['feature_id'] ?>" 
                                name="features[]" 
                                value="<?= $feature['feature_id'] ?>"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring focus:ring-blue-500"
                                <?php 
                                    if (in_array($feature['feature_id'], $feature_ids)) {
                                        echo 'checked';
                                    }
                                ?>>
                            <label for="feature_<?= $feature['feature_id'] ?>" class="ml-2 text-sm text-gray-700">
                                <?= htmlspecialchars($feature['feature_name']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <p>No feature</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">Cập Nhật</button>
            </div>
        </form>
    </div>
</div>

<script>
    function removeImage(image) {
        alert('Đã xóa ảnh: ' + image);
    }
</script>
