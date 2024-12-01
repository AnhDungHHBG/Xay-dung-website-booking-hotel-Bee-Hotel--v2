<?php
$rooms = $data;
?>
<div class="my-5">
    <?php if (empty($rooms)) : ?>
        <div class="text-center text-gray-600">
            <p>No rooms reviews</p>
        </div>
    <?php else : ?>
        <?php foreach ($rooms as $room) : ?>
            <div class="max-w-lg mx-auto bg-white p-5 rounded-lg shadow-lg mb-5">
                <div class="flex items-center">
                    <img src="<?php echo $room['room_image_url']; ?>" alt="Room Image" class="w-1/3 rounded-lg">
                    <div class="ml-5">
                        <h2 class="text-xl font-bold"><?php echo $room['room_type']; ?></h2>
                        <p class="text-gray-600">Price: <?php echo ($room['room_price']); ?> USD</p>
                        <p class="text-gray-600">Check_in: <?php echo ($room['check_in']); ?> </p>
                        <p class="text-gray-600">Check_out: <?php echo ($room['check_out']); ?> </p>
                        <p class="text-gray-600">Capacity: <?php echo ($room['capacity']); ?> </p>
                    </div>
                </div>
                <form action="<?= $route->getLocateClient('post-reviews', ['room_id' => $room['room_id']]) ?>" id="form<?= $room['room_id'] ?>" method="POST" class="mt-4">
                    <label class="block text-gray-700">Your rating:</label>
                    <div class="rating-container" data-room-id="<?php echo $room['room_id']; ?>">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <input type="radio" id="star<?php echo $i . '_' . $room['room_id']; ?>" 
                                   name="rating" 
                                   value="<?php echo $i; ?>" 
                                   class="star-rating hidden" />
                            <label for="star<?php echo $i . '_' . $room['room_id']; ?>" 
                                   class="cursor-pointer text-gray-500 text-xl p-1">★</label>
                        <?php endfor; ?>
                    </div>
                    <label for="comment" class="block text-gray-700">Your review:</label>
                    <textarea id="comment" name="comment" rows="4" class="w-full p-2 border border-gray-300 rounded-md" placeholder="Chia sẻ cảm nhận của bạn về phòng"></textarea>
                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Review</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
  document.querySelectorAll('.rating-container').forEach(container => {
    const roomId = container.getAttribute('data-room-id');
    const stars = container.querySelectorAll('.star-rating');
    const labels = container.querySelectorAll('label');

    stars.forEach(star => {
        star.addEventListener('change', () => {
            const ratingValue = star.value;
            labels.forEach(label => {
                const starValue = label.getAttribute('for').split('_')[0].replace('star', '');
                if (starValue <= ratingValue) {
                    label.classList.add('text-yellow-500');
                    label.classList.remove('text-gray-500');
                } else {
                    label.classList.remove('text-yellow-500');
                    label.classList.add('text-gray-500');
                }
            });
        });
    });
  });

  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', event => {
        const rating = form.querySelector('input[name="rating"]:checked');
        if (!rating) {
            event.preventDefault();
            alert(`Please select a rating`);
        }
    });
  });
</script>
