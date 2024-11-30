<?php
$rooms = $data;
?>
<?php foreach ($rooms as $room) : ?>
<div class="max-w-lg mx-auto bg-white p-5 rounded-lg shadow-lg mb-5">
    <!-- Thông tin phòng -->
    <div class="flex items-center">
        <img src="<?php echo $room['room_image_url']; ?>" alt="Room Image" class="w-1/3 rounded-lg">
        <div class="ml-5">
            <h2 class="text-xl font-bold"><?php echo $room['room_type']; ?></h2>
            <p class="text-gray-600">Giá phòng: <?php echo number_format($room['room_price'], 2); ?> VNĐ</p>
            <p class="text-gray-700"><?php echo nl2br($room['room_description']); ?></p>
        </div>
    </div>

    <!-- Form đánh giá -->
    <form action="submit_review.php" method="POST" class="mt-4">
        <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"> 

        <label for="rating" class="block text-gray-700">Đánh giá của bạn:</label>
        <div class="flex items-center mb-4">
            <!-- Star Rating -->
            <input type="radio" id="star5_<?php echo $room['room_id']; ?>" name="rating" value="5" class="star-rating hidden" />
            <label for="star5_<?php echo $room['room_id']; ?>" class="cursor-pointer text-yellow-500 text-xl">★</label>

            <input type="radio" id="star4_<?php echo $room['room_id']; ?>" name="rating" value="4" class="star-rating hidden" />
            <label for="star4_<?php echo $room['room_id']; ?>" class="cursor-pointer text-yellow-500 text-xl">★</label>

            <input type="radio" id="star3_<?php echo $room['room_id']; ?>" name="rating" value="3" class="star-rating hidden" />
            <label for="star3_<?php echo $room['room_id']; ?>" class="cursor-pointer text-yellow-500 text-xl">★</label>

            <input type="radio" id="star2_<?php echo $room['room_id']; ?>" name="rating" value="2" class="star-rating hidden" />
            <label for="star2_<?php echo $room['room_id']; ?>" class="cursor-pointer text-yellow-500 text-xl">★</label>

            <input type="radio" id="star1_<?php echo $room['room_id']; ?>" name="rating" value="1" class="star-rating hidden" />
            <label for="star1_<?php echo $room['room_id']; ?>" class="cursor-pointer text-yellow-500 text-xl">★</label>
        </div>

        <label for="comment" class="block text-gray-700">Nhận xét của bạn:</label>
        <textarea id="comment" name="comment" rows="4" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Chia sẻ cảm nhận của bạn về phòng"></textarea>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Đánh giá</button>
    </form>
</div>

<script>
    const stars = document.querySelectorAll('.star-rating');
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const ratingValue = this.value;
            const labels = document.querySelectorAll(`label[for="star${ratingValue}_${<?php echo $room['room_id']; ?>}"]`);
            labels.forEach(label => label.classList.add('text-yellow-500'));
            const unselectedStars = document.querySelectorAll(`input[name="rating"][value]:not([value="${ratingValue}"])`);
            unselectedStars.forEach(input => {
                const label = document.querySelector(`label[for="${input.id}"]`);
                label.classList.remove('text-yellow-500');
            });
        });
    });
</script>

<?php endforeach; ?>
