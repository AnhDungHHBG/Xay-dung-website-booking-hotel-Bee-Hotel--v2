<?php 
$booking = $data;
?>
<div class="bg-light-blue py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-lg p-8">
        <h2 class="text-4xl font-semibold text-center text-primary-blue mb-8">Booking Success</h2>

        <!-- User Information -->
        <div>
            <h3 class="text-2xl font-semibold text-second-blue mb-4">User Information</h3>
            <p>
                <strong class="text-lg font-medium text-primary-blue">Name:</strong>
                <?php echo $booking['user_name']; ?>
            </p>
            <p>
                <strong class="text-lg font-medium text-primary-blue">Email:</strong>
                <?php echo $booking['user_email']; ?>
            </p>
            <p>
                <strong class="text-lg font-medium text-primary-blue">Phone:</strong>
                <?php echo $booking['user_phone']; ?>
            </p>
        </div>
        <hr class="my-5 border-t-2 border-dashed border-[#133E87]">

        <!-- Booking Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="space-y-4">
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Booking ID:</strong>
                    <?php echo $booking['booking_id']; ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Check-in Date:</strong>
                    <?php echo date("F j, Y", strtotime($booking['check_in'])); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Check-out Date:</strong>
                    <?php echo date("F j, Y", strtotime($booking['check_out'])); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Number of Guests:</strong>
                    <?php echo $booking['number_of_guests']; ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Total Price:</strong>
                    $<?php echo number_format($booking['total_price'], 2); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Booking Status:</strong>
                    <span
                        class="font-bold text-<?php echo $booking['booking_status'] == 'confirmed' ? 'green' : 'red'; ?>-500">
                        <?php echo ucfirst($booking['booking_status']); ?>
                    </span>
                </p>
            </div>

            <!-- Payment Information -->
            <div class="space-y-4">
                <h3 class="text-2xl font-semibold text-second-blue">Payment Details</h3>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Payment Date:</strong>
                    <?php echo date("F j, Y", strtotime($booking['payment_date'])); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Payment Amount:</strong>
                    $<?php echo number_format($booking['payment_amount'], 2); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Payment Method:</strong>
                    <?php echo ucfirst($booking['payment_method']); ?>
                </p>
                <p>
                    <strong class="text-lg font-medium text-primary-blue">Payment Status:</strong>
                    <span
                        class="font-bold text-<?php echo $booking['payment_status'] == 'completed' ? 'green' : 'red'; ?>-500">
                        <?php echo ucfirst($booking['payment_status']); ?>
                    </span>
                </p>
            </div>
        </div>

        <!-- Room Information -->
        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-second-blue mb-4">Room Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="w-full">
                    <img src="<?php echo $booking['room_image_url']; ?>" alt="Room Image"
                        class="rounded-lg shadow-md w-full h-auto object-cover">
                </div>
                <div class="w-full space-y-4">
                    <p>
                        <strong class="text-lg font-medium text-primary-blue">Room Type:</strong>
                        <?php echo $booking['room_type']; ?>
                    </p>
                    <p>
                        <strong class="text-lg font-medium text-primary-blue">Room Price:</strong>
                        $<?php echo number_format($booking['room_price'], 2); ?>
                    </p>

                    <p>
                        <strong class="text-lg font-medium text-primary-blue">Room Capacity:</strong>
                        <?php echo $booking['capacity']; ?> people
                    </p>

                    <p>
                        <strong class="text-lg font-medium text-primary-blue">Room Description:</strong>
                        <?php echo $booking['room_description']; ?>
                    </p>
                </div>
            </div>
        </div>



    </div>
    <div class="mt-8 text-center">
        <a href="<?= $route->redirectClient('') ?>" class="inline-block bg-primary-blue text-white text-lg font-semibold py-3 px-6 rounded-md 
                       hover:bg-second-blue transition duration-300">
            Back to Home
        </a>
    </div>
</div>