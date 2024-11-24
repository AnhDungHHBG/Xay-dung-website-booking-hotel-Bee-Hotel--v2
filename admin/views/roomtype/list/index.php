<?php
$room_types = $data;
?>

<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Danh Sách Loại Phòng</h1>
        <a href="<?= $route->getLocateAdmin('room-type-add') ?>" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Thêm Loại Phòng</a>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Mã Loại Phòng</th>
                    <th class="border px-4 py-2">Tên Loại Phòng</th>
                    <th class="border px-4 py-2">Mô Tả</th>
                    <th class="border px-4 py-2">Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($room_types as $type): ?>
                    <tr>
                        <td class="border px-4 py-2"><?= htmlspecialchars($type['room_type_id']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($type['type_name']) ?></td>
                        <td class="border px-4 py-2"><?= htmlspecialchars($type['description']) ?></td>
                        <td class="border px-4 py-2">
                            <a href="<?= $route->getLocateAdmin('room-type-edit', ['id' => $type['room_type_id']]) ?>" class="text-blue-600 hover:underline">Sửa</a>
                            <form action="<?= $route->getLocateAdmin('room-type-delete', ['id' => $type['room_type_id']]) ?>" method="POST" style="display:inline;">
                                <button type="submit" class="text-red-600 hover:underline">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>