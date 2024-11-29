<?php
$rooms = $data;
$currentDate = date('Y-m-d');

$filter = isset($_GET['filter_type']) ? $_GET['filter_type'] : '';

$filteredRooms = array_filter($rooms, function ($room) use ($filter, $currentDate) {
    if ($filter === 'check_in') {
        return isset($room['check_in']) && strpos($room['check_in'], $currentDate) === 0;
    } elseif ($filter === 'check_out') {
        return isset($room['check_out']) && strpos($room['check_out'], $currentDate) === 0;
    } elseif ($filter === 'both') {
        return (isset($room['check_in']) && strpos($room['check_in'], $currentDate) === 0) ||
               (isset($room['check_out']) && strpos($room['check_out'], $currentDate) === 0);
    }
    return true; 
});

$rooms = $filteredRooms;
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
                    Check-In and Check-Out
                </label>
                <label class="flex items-center">
                    <input 
                        type="radio" 
                        name="filter_type" 
                        value="check_in" 
                        class="mr-2"
                        <?php echo $filter === 'check_in' ? 'checked' : ''; ?>
                    >
                    Check-in Today
                </label>
                <label class="flex items-center">
                    <input 
                        type="radio" 
                        name="filter_type" 
                        value="check_out" 
                        class="mr-2"
                        <?php echo $filter === 'check_out' ? 'checked' : ''; ?>
                    >
                    Check-out Today 
                </label>
            </form>
        </div>

        <!-- Bảng Hiển Thị Danh Sách Phòng -->
        <div class="overflow-x-auto bg-white shadow rounded-lg p-6">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="border border-gray-300 px-4 py-2">Room Code</th>
                        <th class="border border-gray-300 px-4 py-2">Room Type</th>
                        <th class="border border-gray-300 px-4 py-2">Capacity</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Check-In</th>
                        <th class="border border-gray-300 px-4 py-2">Check-Out</th>
                        <th class="border border-gray-300 px-4 py-2">Confirm Checkin</th> 
                        <th class="border border-gray-300 px-4 py-2">Confirm Checkout</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rooms) > 0): ?>
                        <?php foreach ($rooms as $room): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['room_id']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['type_name']); ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['capacity']); ?> people</td>
                                <td class="border border-gray-300 px-4 py-2">$<?php echo number_format($room['price'], 2); ?></td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <span class="<?php echo $room['availability_status'] ? 'text-green-500' : 'text-red-500'; ?>">
                                        <?=  $room['availability_status'] ?>
                                    </span>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $room['check_in'] ? htmlspecialchars($room['check_in']) : '---'; ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php echo $room['check_out'] ? htmlspecialchars($room['check_out']) : '---'; ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php if ($room['booking_status'] === 'Pending') : ?>
                                        <a href="<?= $route->getLocateAdmin('confirm-checkin', ['room_id' =>$room['room_id'],'user_id_booking' => $room['user_id']]) ?>">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Confirm checkin</button>
                                        </a>
                                    <?php else : ?>
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Confirm checkin</button>
                                    <?php endif; ?>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <?php if ($room['booking_status'] === 'Checked' && $room['payment_status'] === 'Success') : ?>
                                        <a href="<?= $route->getLocateAdmin('confirm-checkout', ['booking_id' => $room['booking_id'], 'user_id_booking' => $room['user_id']]) ?>">

                                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Confirm checkout</button>
                                        </a>
                                    <?php else : ?>
                                        <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Confirm checkout</button>
                                    <?php endif; ?>
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

