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
            <div class="mb-6">

            <!-- Divider -->
            <div class="border-t-2 mt-6 mb-6"></div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Guest Information</h3>
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex gap-5 justify-start items-center">
                            <p class="text-lg font-medium text-gray-700">Name:</p>
                            <p class="text-md text-gray-600"><?php echo htmlspecialchars($user['name']); ?></p>
                        </div>
                        <div class="flex gap-5 justify-start items-center">
                            <p class="text-lg font-medium text-gray-700">Email:</p>
                            <p class="text-md text-gray-600"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex gap-5 justify-start items-center">
                            <p class="text-lg font-medium text-gray-700">Phone:</p>
                            <p class="text-md text-gray-600"><?php echo htmlspecialchars($user['phone']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Booking Form -->
            <div>
                <form method="POST" class="space-y-6">
                <div>
                    <label for="checkin_date" class="block text-md font-medium text-gray-700">Check-in Date: 12-am <span id="checkin-value"></span></label>
                    <input type="date" id="checkin_date" name="checkin_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" >

                    <label for="checkout_date" class="block text-md font-medium text-gray-700 mt-4">Check-out Date: 11h-am <span id="checkout-value"></span></label>
                    <input type="date" id="checkout_date" name="checkout_date" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" >
                    <p id="date-error" class="text-red-500 mt-2 hidden">Check-out date must be later than Check-in date.</p>
                </div>
                    <input type="hidden" name="special_requests" id="special_requests">
                    <input type="hidden" name="amount" id="amount">
                    <div>
                        <label for="number_of_people" class="block text-md font-medium text-gray-700">Number of People</label>
                        <input type="number" id="number_of_people" name="number_of_guests" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" min="1" >
                        <p id="number-of-people-error" class="text-red-500 mt-2 hidden">Number of people must be at least 1.</p>

                    </div>


                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Additional Amenities</h3>
                        <div class="space-y-4" id="amenities-list">
                        <div class="grid grid-cols-2 gap-4">
                            <?php
                            if (!empty($amenityArray) && is_array($amenityArray)) {
                                foreach ($amenityArray as $item) {
                                    if (isset($item['amenity_id']) && isset($item['amenity_type'])) {
                                        echo '<label class="flex items-center">';
                                        echo '<input type="checkbox" value="' . htmlspecialchars($item['amenity_type']) . '" class="mr-2 amenity-checkbox text-blue-500"> ' . htmlspecialchars($item['amenity_type']) . ' (+ ' . $servicePrice . '$)';
                                        echo '</label>';
                                    }
                                }
                            } else {
                                echo '<p>No amenities available.</p>';
                            }
                            ?>
                        </div>

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
    const numberOfPeopleInput = document.getElementById('number_of_people');
    const amenitiesCheckboxes = document.querySelectorAll('.amenity-checkbox');
    const dateError = document.getElementById('date-error');
    const numberOfPeopleError = document.getElementById('number-of-people-error'); // Add error message element



    const roomPrice = <?php echo $roomPrice; ?>;
    const servicePrice = <?php echo $servicePrice; ?>;

    // Lấy ngày hôm nay
    const today = new Date();
    today.setHours(9, 0, 0, 0);  
    const formattedToday = today.toISOString().split('T')[0];

    // Đặt thuộc tính min cho input ngày
    checkinDateInput.min = formattedToday;
    checkoutDateInput.min = formattedToday;
        // Validate the number of people
        function validateNumberOfPeople() {
            const numberOfPeople = parseInt(numberOfPeopleInput.value, 10);

            if (isNaN(numberOfPeople) || numberOfPeople < 1) {
                numberOfPeopleError.textContent = "Number of people must be at least 1.";
                numberOfPeopleError.classList.remove("hidden");
                return false;
            } else if (numberOfPeople > 10) {
                numberOfPeopleError.textContent = "Number of people cannot exceed 10.";
                numberOfPeopleError.classList.remove("hidden");
                return false;
            } else {
                numberOfPeopleError.classList.add("hidden");
                return true;
            }
        }


        function validateDates() {
            const checkinDate = new Date(checkinDateInput.value);
            const checkoutDate = new Date(checkoutDateInput.value);

            // Kiểm tra nếu người dùng chưa chọn ngày
            if (!checkinDateInput.value || !checkoutDateInput.value) {
                dateError.textContent = "Please select both dates.";
                dateError.classList.remove("hidden");
                return false;
            } 
            
            // Kiểm tra ngày trả phòng phải lớn hơn ngày nhận phòng
            if (checkoutDate <= checkinDate) {
                dateError.textContent = "Check-out date must be later than Check-in date.";
                dateError.classList.remove("hidden");
                return false;
            }

            // Kiểm tra ngày nhận phòng không được sớm hơn ngày hôm nay
            if (checkinDate < today) {
                dateError.textContent = "Check-in date cannot be earlier than today.";
                dateError.classList.remove("hidden");
                return false;
            }

            dateError.classList.add("hidden"); 
            return true;
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
        document.getElementById('checkin-value').textContent = checkinDateInput.value || 'Not selected';
        document.getElementById('checkout-value').textContent = checkoutDateInput.value || 'Not selected';

    }

    checkinDateInput.addEventListener('change', () => {
        if (validateDates()) {
            const checkinDate = new Date(checkinDateInput.value);
            checkinDate.setHours(12, 0, 0, 0);
            checkinDateInput.value = checkinDate.toISOString().split('T')[0];
            calculateTotal();
        }
    });
    checkoutDateInput.addEventListener('change', () => {
        if (validateDates()) {
            const checkoutDate = new Date(checkoutDateInput.value);
            checkoutDate.setHours(11, 0, 0, 0);
            checkoutDateInput.value = checkoutDate.toISOString().split('T')[0];
            calculateTotal();
        }
    });
    numberOfPeopleInput.addEventListener('input', validateNumberOfPeople);
    amenitiesCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });

    calculateTotal();
    const form = document.querySelector('form');
    const specialRequestsInput = document.getElementById('special_requests'); 
    const amount = document.getElementById('amount'); 

    form.addEventListener('submit', function (event) {
    const checkinDate = checkinDateInput.value;
    const checkoutDate = checkoutDateInput.value;

    if (!validateDates()) {
        event.preventDefault();
        return;
    }

    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    const selectedAmenities = Array.from(amenitiesCheckboxes)
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

    specialRequestsInput.value = selectedAmenities.join(',');
    const totalPriceElement = document.getElementById('total-price');
    amount.value = totalPriceElement.textContent.trim();

    let actionUrl = '';
    if (paymentMethod === 'vnpay') {
        actionUrl = '<?= $route->getLocateClient('payment-vnpay', ['room_id' => $room['room_id']]) ?>';
    } else if (paymentMethod === 'on_site') {
        actionUrl = '<?= $route->getLocateClient('payment-onsite',['room_id' => $room['room_id']]) ?>';
    }
    form.action = actionUrl;
});

</script>
