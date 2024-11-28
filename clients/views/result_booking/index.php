<?php
$roomId = $data['room_id']; 
$roomName = $data['room_name'];
$checkinDate = $data['checkin_date'];
$checkoutDate = $data['checkout_date'];
$numberOfPeople = $data['number_of_guests'];
$paymentMethod = $data['payment_method'];

$roomPrice = 100; 
$servicePrice = 10; 
$numberOfNights = (strtotime($checkoutDate) - strtotime($checkinDate)) / 86400;  
$totalRoomPrice = $roomPrice * $numberOfNights;
$totalPrice = $totalRoomPrice;

?>

<div class="bg-gray-100 font-sans w-full max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Booking Successful!</h1>
        
        <!-- Thông tin phòng -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Your Booking Details</h2>
            <p class="text-lg text-gray-700 mb-4">Room: <?php echo htmlspecialchars($roomName); ?></p>
            <p class="text-lg text-gray-700 mb-4">Room ID: <?php echo htmlspecialchars($roomId); ?></p>
            <p class="text-lg text-gray-700 mb-4">Check-in Date: <?php echo htmlspecialchars($checkinDate); ?></p>
            <p class="text-lg text-gray-700 mb-4">Check-out Date: <?php echo htmlspecialchars($checkoutDate); ?></p>
            <p class="text-lg text-gray-700 mb-4">Number of Guests: <?php echo htmlspecialchars($numberOfPeople); ?></p>
            <p class="text-lg text-gray-700 mb-4">Total Room Price (<?php echo $numberOfNights; ?> night(s)): <?php echo number_format($totalRoomPrice, 2); ?> $</p>
        </div>

        <!-- Thông tin thanh toán -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Payment Summary</h3>
            <p class="text-lg text-gray-700 mb-2">Room Price: <?php echo number_format($totalRoomPrice, 2); ?> $</p>
            <p class="text-lg text-gray-700 mb-4">Total Payment: <?php echo number_format($totalPrice, 2); ?> $</p>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Payment Method</h3>
            <p class="text-lg text-gray-700">Selected Payment Method: <?php echo htmlspecialchars($paymentMethod); ?></p>
        </div>

        <!-- Thông báo cho lễ tân -->
        <div class="text-lg text-gray-700 mb-8">
            <p class="font-semibold">Please present this information to the front desk upon arrival:</p>
            <ul class="list-disc ml-5">
                <li>Booking ID: <?php echo htmlspecialchars($roomId); ?></li>
                <li>Room Name: <?php echo htmlspecialchars($roomName); ?></li>
                <li>Check-in Date: <?php echo htmlspecialchars($checkinDate); ?></li>
                <li>Check-out Date: <?php echo htmlspecialchars($checkoutDate); ?></li>
                <li>Number of Guests: <?php echo htmlspecialchars($numberOfPeople); ?></li>
                <li>Total Price: <?php echo number_format($totalPrice, 2); ?> $</li>
            </ul>
        </div>

        <!-- Nút quay lại trang chủ -->
        <div class="text-center">
            <a href="home.php" class="w-full bg-green-500 text-white py-3 rounded-md hover:bg-green-600 transition duration-300">Back to Home</a>
        </div>
    </div>
</div>
