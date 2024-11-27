<?php
$amenities = $data;
?>
<div class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Danh sách tiện nghi</h1>
        <a href="<?= $route->getLocateAdmin('amenity-add')?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Thêm tiện nghi</a>
        <table class="table-auto w-full mt-6 bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Tên tiện nghi</th>
                    <th class="px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($amenities as $amenity): ?>
                <tr class="border-t">
                    <td class="px-4 py-2"><?= $amenity['amenity_id'] ?></td>
                    <td class="px-4 py-2"><?= $amenity['amenity_type'] ?></td>
                    <td class="px-4 py-2">
                        <a href="<?= $route->getLocateAdmin('amenity-edit', ['id' => $amenity['amenity_id'] ]) ?>" class="text-blue-500 hover:underline">Sửa</a>
                        <a href="<?= $route->getLocateAdmin('amenity-delete', ['id' => $amenity['amenity_id'] ]) ?>" 
                        onclick="return confirm('Bạn có chắc chắn muốn xóa tiện nghi này?')" 
                        class="text-red-500 hover:underline ml-4">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>