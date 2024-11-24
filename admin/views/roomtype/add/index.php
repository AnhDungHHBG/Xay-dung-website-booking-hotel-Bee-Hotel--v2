<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto mt-10 p-5 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-5 text-center text-gray-800">Thêm Loại Phòng</h1>
        <p class="text-gray-600 mb-4 text-center">Vui lòng điền thông tin loại phòng mới vào biểu mẫu dưới đây.</p>
        <form action="<?= $route->getLocateAdmin('room-type-post-add') ?>" method="POST">
            <div class="mb-4">
                <label for="type_name" class="block text-sm font-medium text-gray-700">Tên Loại Phòng</label>
                <input type="text" id="type_name" name="type_name" placeholder="Nhập tên loại phòng" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Mô Tả</label>
                <textarea id="description" name="description" placeholder="Nhập mô tả loại phòng" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500" rows="4"></textarea>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">Thêm</button>
            </div>
        </form>
    </div>
</div>