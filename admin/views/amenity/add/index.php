
<div class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Thêm tiện nghi</h1>
        <form action="<?= $route->getLocateAdmin('amenity-post-add') ?>" method="POST" class="bg-white p-6 shadow-md rounded-lg">
            <div class="mb-4">
                <label for="amenity_type" class="block text-gray-700 font-medium">Tên tiện nghi</label>
                <input type="text" name="amenity_type" id="amenity_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Thêm</button>
        </form>
    </div>
</div>