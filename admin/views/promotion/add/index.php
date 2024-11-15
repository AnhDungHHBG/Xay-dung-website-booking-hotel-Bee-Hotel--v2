<div class="p-8 bg-white shadow-lg rounded-lg max-w-xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Thêm Khuyến mãi Mới</h1>
    <form action="<?= $route->getLocateAdmin('promotion-post-add') ?>" method="POST">
        <div class="mb-5">
            <label for="promotion_name" class="block text-lg font-medium text-gray-700 mb-2">Tên Khuyến mãi</label>
            <div class="relative">
                <input type="text" name="promotion_name" id="promotion_name" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out hover:border-blue-400" placeholder="Nhập tên khuyến mãi" required>
                <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <i class="fas fa-tag"></i>
                </span>
            </div>
        </div>
        <div class="mb-5">
            <label for="discount_rate" class="block text-lg font-medium text-gray-700 mb-2">Tỷ lệ giảm giá (%)</label>
            <div class="relative">
                <input type="number" name="discount_rate" id="discount_rate" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out hover:border-blue-400" placeholder="Nhập tỷ lệ giảm giá" required>
                <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <i class="fas fa-percent"></i>
                </span>
            </div>
        </div>
        <div class="mb-5">
            <label for="start_date" class="block text-lg font-medium text-gray-700 mb-2">Ngày bắt đầu</label>
            <div class="relative">
                <input type="text" name="start_date" id="start_date" class="date-picker w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out hover:border-blue-400" required>
                <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <i class="fas fa-calendar-alt"></i>
                </span>
            </div>
        </div>
        <div class="mb-5">
            <label for="end_date" class="block text-lg font-medium text-gray-700 mb-2">Ngày kết thúc</label>
            <div class="relative">
                <input type="text" name="end_date" id="end_date" class="date-picker w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-lg p-3 transition duration-200 ease-in-out hover:border-blue-400" required>
                <span class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                    <i class="fas fa-calendar-check"></i>
                </span>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out shadow-md hover:shadow-lg">Lưu</button>
        </div>
    </form>
</div>

<script>
    // Khởi tạo Flatpickr cho các trường ngày
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.date-picker', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'F j, Y',
            minDate: 'today'
        });
    });
</script>