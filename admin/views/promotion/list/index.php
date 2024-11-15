<div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-4 text-center text-gray-800">Quản lý Khuyến mãi</h1>
    <div class="flex justify-between mb-4">
        <form action="" method="GET" class="flex space-x-4">
            <input type="text" name="name" placeholder="Tên Khuyến mãi" class="border border-gray-300 rounded-md p-2" value="<?= ($_GET['name'] ?? '') ?>">
            <input type="number" name="discount_rate" placeholder="Tỷ lệ giảm giá" class="border border-gray-300 rounded-md p-2" value="<?= ($_GET['discount_rate'] ?? '') ?>">
            <input type="date" name="start_date" class="border border-gray-300 rounded-md p-2" value="<?= ($_GET['start_date'] ?? '') ?>">
            <input type="date" name="end_date" class="border border-gray-300 rounded-md p-2" value="<?= ($_GET['end_date'] ?? '') ?>">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Lọc</button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <?php
                    $sort = $_GET['sort'] ?? '';
                    $order = $_GET['order'] ?? 'asc';
                    $nextOrder = $order === 'asc' ? 'desc' : 'asc';
                    ?>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">
                        <a href="<?= $route->getLocateAdmin('promotion-list', array_merge($_GET, ['sort' => 'promotion_name', 'order' => $nextOrder])) ?>">
                            Tên Khuyến mãi
                            <?php if ($sort === 'promotion_name'): ?>
                                <i class="fas fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?>"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">
                        <a href="<?= $route->getLocateAdmin('promotion-list', array_merge($_GET, ['sort' => 'discount_rate', 'order' => $nextOrder])) ?>">
                            Tỷ lệ giảm giá (%)
                            <?php if ($sort === 'discount_rate'): ?>
                                <i class="fas fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?>"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">
                        <a href="<?= $route->getLocateAdmin('promotion-list', array_merge($_GET, ['sort' => 'start_date', 'order' => $nextOrder])) ?>">
                            Ngày bắt đầu
                            <?php if ($sort === 'start_date'): ?>
                                <i class="fas fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?>"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">
                        <a href="<?= $route->getLocateAdmin('promotion-list', array_merge($_GET, ['sort' => 'end_date', 'order' => $nextOrder])) ?>">
                            Ngày kết thúc
                            <?php if ($sort === 'end_date'): ?>
                                <i class="fas fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?>"></i>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($data as $promotion): ?>
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($promotion['promotion_name']) ?></td>
                    <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($promotion['discount_rate']) ?></td>
                    <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($promotion['start_date']) ?></td>
                    <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($promotion['end_date']) ?></td>
                    <td class="py-3 px-4 text-sm">
                        <a href="<?= $route->getLocateAdmin('promotion-edit', ['id' => $promotion['promotion_id'] ]) ?>?>" class="text-blue-500 hover:text-blue-700 hover:underline">Chỉnh sửa</a>
                        <a href="<?= $route->getLocateAdmin('promotion-delete', ['id' => $promotion['promotion_id'] ]) ?>" class="ml-2 text-red-500 hover:text-red-700 hover:underline">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
