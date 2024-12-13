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

<div class="bg-gray-50 py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold text-center text-[#133E87] mb-8">List of Check-In and Check-Out Rooms Today
        </h1>
        <!-- Filter Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <form method="GET" id="filterForm" class="space-y-4">
                <div class="flex justify-between items-center">
                    <label class="flex items-center text-[#133E87]">
                        <input type="radio" name="filter_type" value="both" class="mr-2"
                            <?php echo $filter === 'both' ? 'checked' : ''; ?>>
                        Check-In and Check-Out
                    </label>
                    <label class="flex items-center text-[#133E87]">
                        <input type="radio" name="filter_type" value="check_in" class="mr-2"
                            <?php echo $filter === 'check_in' ? 'checked' : ''; ?>>
                        Check-In Today
                    </label>
                    <label class="flex items-center text-[#133E87]">
                        <input type="radio" name="filter_type" value="check_out" class="mr-2"
                            <?php echo $filter === 'check_out' ? 'checked' : ''; ?>>
                        Check-Out Today
                    </label>
                </div>
            </form>
        </div>

        <!-- Room List Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-[#133E87] text-white">
                        <th class="border border-gray-300 px-4 py-2">Room (ID)</th>
                        <th class="border border-gray-300 px-4 py-2">User</th>
                        <th class="border border-gray-300 px-4 py-2">Capacity</th>
                        <th class="border border-gray-300 px-4 py-2">Price</th>
                        <th class="border border-gray-300 px-4 py-2">Payment Status</th>
                        <th class="border border-gray-300 px-4 py-2">Check-In</th>
                        <th class="border border-gray-300 px-4 py-2">Check-Out</th>
                        <th class="border border-gray-300 px-4 py-2">Confirm Check-In</th>
                        <th class="border border-gray-300 px-4 py-2">Confirm Check-Out</th>
                        <th class="border border-gray-300 px-4 py-2">Reset Room</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rooms) > 0): ?>
                    <?php foreach ($rooms as $room): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 px-4 py-2">
                            <a class="text-[#133E87] font-semibold hover:underline"
                                href="<?= $route->getLocateAdmin('booking-detail', ['booking_id' => $room['booking_id']]) ?>">
                                <?php echo htmlspecialchars($room['room_id']); ?> (Detail)
                            </a>
                        </td>
                        <td class="text-center font-medium">
                            <?php echo $room['user_name'] ? htmlspecialchars($room['user_name']) : '---'; ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($room['capacity']); ?>
                            people</td>
                        <td class="border border-gray-300 px-4 py-2">$<?php echo number_format($room['price'], 2); ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span
                                class="<?php echo $room['payment_status'] === 'Success' ? 'text-green-500' : 'text-red-500'; ?>">
                                <?= htmlspecialchars($room['payment_status']) ?>
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo $room['check_in'] ? htmlspecialchars($room['check_in']) : '---'; ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php echo $room['check_out'] ? htmlspecialchars($room['check_out']) : '---'; ?></td>

                        <!-- Confirm Buttons -->
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if ($room['booking_status'] === 'Pending') : ?>
                            <a
                                href="<?= $route->getLocateAdmin('confirm-checkin', ['room_id' => $room['room_id'], 'user_id_booking' => $room['user_id']]) ?>">
                                <button class="bg-[#133E87] text-white px-4 py-2 rounded-lg hover:bg-[#608BC1]">Confirm
                                    Check-In</button>
                            </a>
                            <?php else : ?>
                            <button class="bg-gray-500 text-white px-4 py-1 rounded" disabled>Confirm Check-In</button>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if ($room['booking_status'] === 'Checked' && $room['payment_status'] === 'Success') : ?>
                            <a
                                href="<?= $route->getLocateAdmin('confirm-checkout', ['booking_id' => $room['booking_id'], 'user_id_booking' => $room['user_id']]) ?>">
                                <button class="bg-[#133E87] text-white px-4 py-2 rounded-lg hover:bg-[#608BC1]">Confirm
                                    Check-Out</button>
                            </a>
                            <?php else : ?>
                            <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Confirm Check-Out</button>
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if ($room['booking_status'] === 'Checkout') : ?>
                            <a class="bg-[#133E87] text-white px-4 py-2 rounded-lg hover:bg-[#608BC1]"
                                href="<?= $route->getLocateAdmin('reset-room', ['room_id' => $room['room_id']]) ?>">
                                Reset Now
                            </a>
                            <?php else : ?>
                            <button class="bg-gray-500 text-white px-4 py-2 rounded" disabled>Reset Now</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                            No rooms available.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>