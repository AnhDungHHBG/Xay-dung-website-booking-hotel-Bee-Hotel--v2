<?php
$room = $data['room'];
$amenity = $data['amenity'];

$roomId = isset($room['room_id']) ? $room['room_id'] : 'Not Room';
$roomName = isset($room['room_type']) ? $room['room_type'] : 'Room not named';
$roomType = isset($room['type']) ? $room['type'] : 'Not specified';
$roomPrice = isset($room['price']) ? $room['price'] : 0;

$amenityArray = is_array($amenity) ? $amenity : (array) $amenity;   

$servicePrice = 10;
?>
<div class="bg-gray-100 font-sans w-full max-w-6xl mx-auto px-4 py-8">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Room Booking Details</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Room Details -->
            <div>
                <h2 class="text-2xl font-semibold mb-4">Room: <?php echo htmlspecialchars($roomId); ?></h2>
                <p class="text-lg text-gray-700 mb-4">Type: <?php echo htmlspecialchars($roomName); ?></p>
                <p class="text-md text-gray-600 mb-4">Price: <?php echo number_format($roomPrice, 2, '.', ',') . ' $ / night'; ?></p>

                <div>
                    <h3 class="text-xl font-semibold mb-2">Room Images:</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 gap-2">
                        <?php
                         $images = isset($room['images']) ? explode(', ', $room['images']) : [];
                         $maxImages = 8; 
                         $imagesToShow = array_slice($images, 0, $maxImages);  
     
                         foreach ($imagesToShow as $image) {
                             echo '<img src="' . htmlspecialchars($image) . '" alt="Room Image" class="w-full h-40 object-cover rounded-md shadow">';
                         }
                         ?>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div>
                <form method="POST" class="space-y-6">
                    <div>
                        <label for="checkin_date" class="block text-md font-medium text-gray-700">Check-in Date</label>
                        <input type="date" id="checkin_date" name="checkin_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>

                        <label for="checkout_date" class="block text-md font-medium text-gray-700 mt-4">Check-out Date</label>
                        <input type="date" id="checkout_date" name="checkout_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <p id="date-error" class="text-red-500 mt-2 hidden">Check-out date must be later than Check-in date.</p>
                    </div>

                    <div>
                        <label for="special_requests" class="block text-md font-medium text-gray-700">Special Request</label>
                        <input type="text" id="special_requests" name="special_requests" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" >
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Additional Amenities</h3>
                        <div class="space-y-4" id="amenities-list">
                            <?php
                            if (!empty($amenityArray) && is_array($amenityArray)) {
                                foreach ($amenityArray as $item) {
                                    if (isset($item['amenity_id']) && isset($item['amenity_type'])) {
                                        echo '<label class="flex items-center">';
                                        echo '<input type="checkbox" name="services[]" value="' . htmlspecialchars($item['amenity_id']) . '" class="mr-2 amenity-checkbox text-blue-500"> ' . htmlspecialchars($item['amenity_type']) . ' (+ ' . $servicePrice . '$)';
                                        echo '</label>';
                                    }
                                }
                            } else {
                                echo '<p>No amenities available.</p>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="mt-6 p-4 border-t-2 border-gray-200">
                        <p class="font-semibold text-gray-800">Number of nights: <span id="number-of-nights">0</span> nights</p>
                        <p class="font-semibold text-gray-800">Room Total: <span id="room-price">0</span> $</p>
                        <p class="font-semibold text-gray-800">Service Total: <span id="service-price">0</span> $</p>
                        <p class="font-semibold text-gray-800">Total Payment: <span id="total-price">0</span> $</p>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-800 mt-4">Select Payment Method:</h3>
                    <div class="flex justify-start items-center gap-16">
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="vnpay" class="mr-2" checked> Pay with VN Pay
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="on_site" class="mr-2"> Pay at Check-in
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-md hover:bg-blue-600 transition duration-300">Confirm and Pay</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const checkinDateInput = document.getElementById('checkin_date');
    const checkoutDateInput = document.getElementById('checkout_date');
    const amenitiesCheckboxes = document.querySelectorAll('.amenity-checkbox');
    const dateError = document.getElementById('date-error');

    const roomPrice = <?php echo $roomPrice; ?>;
    const servicePrice = <?php echo $servicePrice; ?>;

    function validateDates() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        if (checkinDate && checkoutDate && checkoutDate <= checkinDate) {
            dateError.classList.remove('hidden');
            return false;
        } else {
            dateError.classList.add('hidden');
            return true;
        }
    }

    function calculateTotal() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        let numberOfNights = 0;
        if (checkinDate && checkoutDate && !isNaN(checkinDate) && !isNaN(checkoutDate)) {
            numberOfNights = Math.ceil((checkoutDate - checkinDate) / (1000 * 3600 * 24));
        }

        const selectedAmenitiesCount = Array.from(amenitiesCheckboxes).filter(checkbox => checkbox.checked).length;
        
        const totalRoomPrice = roomPrice * numberOfNights;
        const totalServicePrice = selectedAmenitiesCount * servicePrice;
        const totalPrice = totalRoomPrice + totalServicePrice;

        document.getElementById('number-of-nights').textContent = numberOfNights;
        document.getElementById('room-price').textContent = totalRoomPrice.toFixed(2);
        document.getElementById('service-price').textContent = (selectedAmenitiesCount * servicePrice).toFixed(2);
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }

    checkinDateInput.addEventListener('change', () => {
        if (validateDates()) {
            calculateTotal();
        }
    });
    checkoutDateInput.addEventListener('change', () => {
        if (validateDates()) {
            calculateTotal();
        }
    });
    amenitiesCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });

    calculateTotal();
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        const checkinDate = checkinDateInput.value;
        const checkoutDate = checkoutDateInput.value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const totalPriceElement = document.getElementById('total-price');

        if (!checkinDate || !checkoutDate) {
            event.preventDefault();
            alert('Please select both check-in and check-out dates.');
        } else if (!validateDates()) {
            event.preventDefault();
            alert('Check-out date must be later than check-in date.');
        } else {
            const totalPrice = totalPriceElement.textContent.trim();
            let actionUrl = '';
            if (paymentMethod === 'vnpay') {
                // Use JavaScript to inject the totalPrice dynamically
                actionUrl = '<?= $route->getLocateClient('payment-vnpay') ?>';
            } else if (paymentMethod === 'on_site') {
                actionUrl = '<?= $route->getLocateClient('payment-onsite') ?>';
            }

            form.action = actionUrl;
        }
    });


</script>
