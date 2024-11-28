<?php

$rooms = $data;
?>

<div class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5 text-center">Danh Sách Phòng</h1>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 border-b">ID Phòng</th>
                    <th class="py-3 px-4 border-b">Tên Loại Phòng</th>
                    <th class="py-3 px-4 border-b">Giá</th>
                    <th class="py-3 px-4 border-b">Sức Chứa</th>
                    <th class="py-3 px-4 border-b">Tình Trạng</th>
                    <th class="py-3 px-4 border-b">Mô Tả</th>
                    <th class="py-3 px-4 border-b">Hình Ảnh</th>
                    <th class="py-3 px-4 border-b">Tiện Ích</th>
                    <th class="py-3 px-4 border-b">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['room_id']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['type_name']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['price']) ?> VNĐ</td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['capacity']) ?> người</td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['availability_status']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($room['description']) ?></td>
                        <td class="py-2 px-4 border-b">
                            <?php if (!empty($room['image_urls'])): ?>
                                <?php $images = explode(', ', $room['image_urls']); ?>
                                <div class="flex flex-wrap">
                                    <?php foreach ($images as $index => $image): ?>
                                        <?php if ($index < 4): ?>
                                            <img src="<?= htmlspecialchars($image) ?>" alt="Hình ảnh phòng" class="w-27 h-24 object-cover rounded m-1">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                Không có hình
                            <?php endif; ?>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <?php if (!empty($room['features'])): ?>
                                <?php $features = explode(', ', $room['features']); ?>
                                <ul class="list-decimal pl-5">
                                    <?php foreach ($features as $feature): ?>
                                        <li class="text-gray-700"><?= htmlspecialchars($feature) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                Không có tiện ích
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-4 text-sm flex gap-4  items-start">
                        <a href="<?= $route->getLocateAdmin('room-edit', ['id' => $room['room_id'] ]) ?>?>" class="text-blue-500 hover:text-blue-700 hover:underline">Chỉnh sửa</a>
                        <form action="<?= $route->getLocateAdmin('room-delete', ['id' => $room['room_id'] ]) ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                            <button type="submit" class="ml-2 text-red-500 hover:text-red-700 hover:underline">Xóa</button>
                        </form>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

