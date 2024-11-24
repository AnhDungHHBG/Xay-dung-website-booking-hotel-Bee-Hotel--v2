<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6 mt-10">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Thêm Tiện ích Mới</h2>
    <form action="<?= $route->getLocateAdmin('feature-post-add') ?>" method="POST">
        <!-- Tên Tiện ích -->
        <div class="mb-4">
            <label for="feature_name" class="block text-sm font-medium text-gray-600 mb-1">Tên Tiện ích</label>
            <input type="text" 
                   id="feature_name" 
                   name="feature_name" 
                   class="w-full px-4 py-2 border rounded-lg text-sm text-gray-700 focus:ring focus:ring-blue-300 focus:outline-none"
                   placeholder="Nhập tên tiện ích" 
                   required>
        </div>

        <!-- Nút Lưu -->
        <div class="flex items-center justify-between">
            <button type="submit" 
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300 transition-all">
                Lưu Tiện Ích
            </button>
            <a href="<?= $route->getLocateAdmin('feature-list') ?>" 
               class="text-sm text-gray-500 hover:underline hover:text-gray-700 transition-all">
                Hủy
            </a>
        </div>
    </form>
</div>
