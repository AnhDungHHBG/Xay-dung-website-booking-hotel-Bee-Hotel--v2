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
<div class="bg-gray-100 font-sans w-[1000px] mx-auto">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-6">Room Booking Details</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex items-start justify-start gap-10">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Room number: <?php echo htmlspecialchars($roomId); ?></h2>
                    <p class="text-lg mb-4">Room Type: <?php echo htmlspecialchars($roomName); ?></p>
                    <p class="text-md mb-4">Price: <?php echo number_format($roomPrice, 2, '.', ',') . ' $ / night'; ?></p>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-semibold mb-2">Room Images:</h3>
                    <div class="flex space-x-4">
                        <?php
                         $images = isset($room['images']) ? explode(', ', $room['images']) : [];
                         $maxImages = 8; 
                         $imagesToShow = array_slice($images, 0, $maxImages);  
     
                         foreach ($imagesToShow as $image) {
                             echo '<img src="' . htmlspecialchars($image) . '" alt="Room Image" class="w-32 h-32 object-cover rounded-md">';
                         }
                         ?>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label for="checkin_date" class="block text-md font-medium mb-2">Check-in Date</label>
                <input type="date" id="checkin_date" name="checkin_date" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>

                <label for="checkout_date" class="block text-md font-medium mt-4 mb-2">Check-out Date</label>
                <input type="date" id="checkout_date" name="checkout_date" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                <p id="date-error" class="text-red-500 mt-2 hidden">Check-out date must be later than Check-in date.</p>

            </div>

            <form method="POST" class="flex gap-20 justify-start items-start ">
               <div>
                <h3 class="text-xl font-semibold mb-2">Additional Amenities:</h3>
                    <div class="space-y-4" id="amenities-list">
                        <?php
                        if (!empty($amenityArray) && is_array($amenityArray)) {
                            foreach ($amenityArray as $item) {
                                if (isset($item['amenity_id']) && isset($item['amenity_type'])) {
                                    echo '<label class="flex items-center">';
                                    echo '<input type="checkbox" name="services[]" value="' . htmlspecialchars($item['amenity_id']) . '" class="mr-2 amenity-checkbox"> ' . htmlspecialchars($item['amenity_type']) . ' (+ ' . $servicePrice . '$)';
                                    echo '</label>';
                                }
                            }
                        } else {
                            echo '<p>No amenities available.</p>';
                        }
                        ?>
                    </div>
               </div>

              <div>
                <div class="mt-4">
                        <p class="font-semibold">Number of nights: <span id="number-of-nights">0</span> nights</p>
                        <p class="font-semibold">Room Total: <span id="room-price">0</span> $</p>
                        <p class="font-semibold">Service Total: <span id="service-price">0</span> $</p>
                        <p class="font-semibold">Total Payment: <span  id="total-price">0</span> $</p>
                </div>
                    <button type="submit" class="mt-6 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Confirm and Pay With VN Pay</button>
              </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Get necessary elements
    const checkinDateInput = document.getElementById('checkin_date');
    const checkoutDateInput = document.getElementById('checkout_date');
    const amenitiesCheckboxes = document.querySelectorAll('.amenity-checkbox');
    const dateError = document.getElementById('date-error');

    const roomPrice = <?php echo $roomPrice; ?>;
    const servicePrice = <?php echo $servicePrice; ?>;

    // Function to validate the dates
    function validateDates() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        // Validate if check-out date is later than check-in date
        if (checkinDate && checkoutDate && checkoutDate <= checkinDate) {
            dateError.classList.remove('hidden');
            return false;
        } else {
            dateError.classList.add('hidden');
            return true;
        }
    }

    // Function to calculate total
    function calculateTotal() {
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);

        let numberOfNights = 0;
        if (checkinDate && checkoutDate && !isNaN(checkinDate) && !isNaN(checkoutDate)) {
            // Calculate the number of nights
            numberOfNights = Math.ceil((checkoutDate - checkinDate) / (1000 * 3600 * 24));
        }

        const selectedAmenitiesCount = Array.from(amenitiesCheckboxes).filter(checkbox => checkbox.checked).length;
        
        const totalRoomPrice = roomPrice * numberOfNights;
        const totalServicePrice = selectedAmenitiesCount * servicePrice;
        const totalPrice = totalRoomPrice + totalServicePrice;

        // Update UI with calculated values
        document.getElementById('number-of-nights').textContent = numberOfNights;
        document.getElementById('room-price').textContent = totalRoomPrice.toFixed(2);
        document.getElementById('service-price').textContent = (selectedAmenitiesCount * servicePrice).toFixed(2);
        document.getElementById('total-price').textContent = totalPrice.toFixed(2);
    }

    // Listen for changes in check-in date, check-out date, and amenities selection
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

    // Calculate the initial total if dates are already selected
    calculateTotal();
    // Lắng nghe sự kiện khi người dùng cố gắng gửi form
    const totalPriceElement = document.getElementById('total-price');
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        // Kiểm tra xem người dùng đã chọn cả ngày check-in và check-out chưa
        const checkinDate = checkinDateInput.value;
        const checkoutDate = checkoutDateInput.value;

        if (!checkinDate || !checkoutDate) {
            event.preventDefault(); // Ngừng gửi form
            alert('Please select both check-in and check-out dates.');
        } else if (!validateDates()) {
            event.preventDefault(); // Ngừng gửi form nếu ngày không hợp lệ
            alert('Check-out date must be later than check-in date.');
        } else {
            // Lấy giá trị total_price và thêm vào action của form
            const totalPrice = totalPriceElement.textContent.trim();

            // Thay đổi action để bao gồm giá trị total_payment
            const actionUrl = `<?= $route->getLocateClient('payment-vnpay', ['total_payment' => '']) ?>${totalPrice}`;
            form.action = actionUrl;
        }
    });

</script>
