<?php
$booking = $data;
?>

<div class="max-w-7xl mx-auto p-8 bg-white shadow-xl rounded-lg">
    <h2 class="text-4xl font-semibold text-[#133E87] text-center">Booking Details</h2>

    <!-- Back Button and Title -->
    <div class="flex justify-between items-center mb-10">
        <a href="javascript:history.back()"
            class="inline-flex items-center px-6 py-3 bg-[#133E87] text-white font-semibold rounded-lg hover:bg-[#3a67b1] transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#133E87] focus:ring-opacity-50">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <!-- Booking Information -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-8">
        <div>
            <p class="font-medium text-[#133E87]">Booking ID:</p>
            <p class="text-xl text-[#608BC1] font-semibold">#<?php echo $booking['booking_id']; ?></p>
        </div>
        <div>
            <p class="font-medium text-[#133E87]">Check-In Date:</p>
            <p class="text-[#608BC1]"><?php echo date('d-m-Y H:i', strtotime($booking['check_in'])); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">Check-Out Date:</p>
            <p class="text-[#608BC1]"><?php echo date('d-m-Y H:i', strtotime($booking['check_out'])); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-8">
        <div>
            <p class="font-medium text-[#133E87]">User Name:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['user_name']); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">User Email:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['user_email']); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">User Phone:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['user_phone']); ?></p>
        </div>
    </div>

    <!-- Status and Payment Info -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-8">
        <div>
            <p class="font-medium text-[#133E87]">Booking Status:</p>
            <p
                class="text-<?php echo $booking['booking_status'] === 'Pending' ? 'yellow-500' : 'green-500'; ?> font-semibold">
                <?php echo htmlspecialchars($booking['booking_status']); ?>
            </p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">Payment Method:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['payment_method']); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">Payment Status:</p>
            <p
                class="text-<?php echo $booking['payment_status'] === 'Pending' ? 'red-500' : 'green-500'; ?> font-semibold">
                <?php echo htmlspecialchars($booking['payment_status']); ?>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-8">
        <div>
            <p class="font-medium text-[#133E87]">Room Type:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['room_type_name']); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">Special Requests:</p>
            <p class="text-[#608BC1]"><?php echo htmlspecialchars($booking['special_requests']); ?></p>
        </div>

        <div>
            <p class="font-medium text-[#133E87]">Number of Guests:</p>
            <p class="text-[#608BC1]"><?php echo $booking['number_of_guests']; ?> people</p>
        </div>
    </div>
    <div class="mt-8">
        <p class="font-medium text-[#133E87] mb-4">Room Images:</p>
        <div class="flex space-x-6 overflow-x-auto">
            <?php foreach ($booking['room_images'] as $image) : ?>
            <img src="<?php echo htmlspecialchars($image); ?>" alt="Room Image"
                class="w-40 h-40 object-cover rounded-lg shadow-lg ">
            <?php endforeach; ?>
        </div>
    </div>
    <hr class="my-8 border-[#e5e7eb]" />

    <!-- Total Price -->
    <div class="flex items-center mb-8">
        <p class="font-medium text-[#133E87] text-lg">Total Price:</p>
        <p class="text-[#608BC1] text-xl font-semibold ml-4">
            $<?php echo number_format($booking['total_price'], 2); ?></p>
    </div>

    <!-- Room Images -->

</div>