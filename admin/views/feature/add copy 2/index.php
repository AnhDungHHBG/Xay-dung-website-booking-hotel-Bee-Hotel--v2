<table class="min-w-full border-collapse border border-gray-200 shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">ID Tiện ích</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Tên Tiện ích</th>
            <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Hành động</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <?php foreach ($data as $feature): ?>
        <tr class="hover:bg-gray-50 transition-all duration-200">
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($feature['feature_id']) ?></td>
            <td class="py-3 px-4 text-sm text-gray-700"><?= htmlspecialchars($feature['feature_name']) ?></td>
            <td class="py-3 px-4 text-sm flex gap-4 items-center">
                <a href="<?= $route->getLocateAdmin('feature-edit', ['id' => $feature['feature_id']]) ?>" 
                   class="px-3 py-1 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 hover:shadow-md transition-all">
                   Chỉnh sửa
                </a>
                <form action="<?= $route->getLocateAdmin('feature-delete', ['id' => $feature['feature_id']]) ?>" 
                      method="POST" 
                      onsubmit="return confirm('Bạn có chắc chắn muốn xóa tiện ích này?');">
                    <button type="submit" 
                            class="px-3 py-1 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 hover:shadow-md transition-all">
                            Xóa
                    </button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
