<!-- View (HTML/PHP file) -->
<?php
$rooms = $data; 


// Kiểm tra lọc được chọn
$filter = isset($_GET['filter_type']) ? $_GET['filter_type'] : 'both';
?>

<div class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Danh sách phòng hôm nay</h1>

        <!-- Phần Lọc -->
        <div class="bg-white shadow rounded-lg p-4 mb-6">
            <form method="GET" id="filterForm">
                <label class="flex items-center">
                    <input 
                        type="radio" 
                        name="filter_type" 
                        value="both" 
                        class="mr-2"
                        <?php echo $filter === 'both' ? 'checked' : ''; ?>
                    >
                    Cả hai (Check-In và Check-Out)
                </label>
                <label class="flex items-center">
                    <input 
                        type="radio" 
                        name="filter_type" 
                        value="check_in" 
                        class="mr-2"
                        <?php echo $filter === 'check_in' ? 'checked' : ''; ?>
                    >
                    Check-In hôm nay
                </label>
                <label class="flex items-center">
                    <input 
                        type="radio" 
                        name="filter_type" 
                        value="check_out" 
                        class="mr-2"
                        <?php echo $filter === 'check_out' ? 'checked' : ''; ?>
                    >
                    Check-Out hôm nay
                </label>
            </form>
        </div>

        <!-- Bảng Hiển Thị Danh Sách Phòng -->
        <div class="overflow-x-auto bg-white shadow rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">Mã Phòng</th>
                        <th class="border border-gray-300 px-4 py-2">Loại Phòng</th>
                        <th class="border border-gray-300 px-4 py-2">Sức Chứa</th>
                        <th class="border border-gray-300 px-4 py-2">Giá</th>
                        <th class="border border-gray-300 px-4 py-2">Tình Trạng</th>
                        <th class="border border-gray-300 px-4 py-2">Check-In</th>
                        <th class="border border-gray-300 px-4 py-2">Check-Out</th>
                        <th class="border border-gray-300 px-4 py-2">Confirm</th> <!-- Cột Confirm mới -->

                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rooms) > 0): ?>
                        <?php foreach ($rooms as $room): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['room_id']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['type_name']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['capacity']); ?> người</td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo number_format($room['price'], 2); ?> VNĐ</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="<?php echo $room['availability_status'] ? 'text-green-500' : 'text-red-500'; ?>">
                                        <?php echo $room['availability_status'] ? 'Còn trống' : 'Đã đặt'; ?>
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $room['check_in'] ? htmlspecialchars($room['check_in']) : '---'; ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $room['check_out'] ? htmlspecialchars($room['check_out']) : '---'; ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <a href="<?= $route->getLocateAdmin('confirm-checkin', ['room_id' =>$room['room_id'] ]) ?>" >
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded">Confirm</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                Không có phòng nào trong hôm nay.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    
    filterForm.addEventListener('change', function() {
        filterForm.submit(); 
    });

    const filterType = "<?php echo $filter; ?>";
    
    if (filterType === 'check_in') {

    } else if (filterType === 'check_out') {

    } else {

    }

    console.log(actionUrl);   
    filterForm.action = actionUrl;
});

</script>
