<?php 
$reviews = $data['reviews'];
$room = $data['room'];
$averageRating = $data['averageRating'];
?>

<div class="bg-gray-100">
  
  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8">
    <!-- Image Section -->
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2 space-y-4">
          <?php 
                $images = explode(", ", $room['images']);
          ?>
            <!-- Room Main Image -->
            <div class="h-64 bg-gray-300" style="background-image: url('<?= htmlspecialchars($images[0]) ?>'); background-size: cover; background-position: center;"></div>
            
            <!-- Thumbnail Images -->
            <div class="flex space-x-4">
                <?php
                foreach ($images as $image) {
                    echo '<div class="h-32 w-1/2 bg-gray-300" style="background-image: url(\'' . htmlspecialchars($image) . '\'); background-size: cover; background-position: center;"></div>';
                }
                ?>
            </div>
        </div>

       <!-- "More Photos" Section -->
      <div class="h-64 bg-gray-300 flex justify-center items-center text-gray-500" style="background-image: url('<?= htmlspecialchars($images[count($images) - 1]) ?>')">
          <?php
          if (count($images) > 4) {
              echo '+' . (count($images) - 4);
          }
          ?>
      </div>

    </div>

    <!-- Property Info -->
    <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <!-- Room Title and Description -->
            <h1 class="text-2xl font-bold"><?= htmlspecialchars($room['room_type']) ?></h1>
            <p class="text-gray-600"><?= htmlspecialchars($room['description']) ?></p>

            <!-- Room Details -->
            <div class="flex items-center space-x-6 mt-4">
                <div class="text-gray-600 flex items-center space-x-2">
                    <span class="text-lg font-semibold"><?= htmlspecialchars($room['capacity']) ?> Guests</span>
                </div>
                <div class="text-gray-600 flex items-center space-x-2">
                    <span class="text-lg font-semibold">Price: $<?= number_format($room['price'], 2) ?></span>
                </div>
            </div>

            <div class="mt-6">
            <h2 class="text-lg font-semibold">Offered Amenities</h2>
            <ul class="list-disc pl-6 mt-4 text-gray-600">
                <?php
                $feature_names = explode(", ", $room['feature_names']);
                
                foreach ($feature_names as $feature_name) {
                    echo '<li><i class="fas fa-check mr-2"></i>' . htmlspecialchars($feature_name) . '</li>';
                }
                ?>
            </ul>
        </div>
        </div>

        <div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-800">$<?= number_format($room['price'], 2) ?> per night</h2>
                <ul class="text-gray-600 mt-4 space-y-2">
                    <li>Short Period: $<?= number_format($room['price'], 2) ?></li>
                    <li>Medium Period: $<?= number_format($room['price'] * 1.5, 2) ?></li>
                    <li>Long Period: $<?= number_format($room['price'] * 2, 2) ?></li>
                </ul>
                <a href="<?= $route->getLocateClient('booking-detail', ['room_id' => $room['room_id']]) ?>">
                  <button class="bg-blue-600 text-white w-full py-2 mt-4 rounded-md">Reserve Now</button>
                </a>
                <div class="mt-4 flex space-x-4">
                    <a href="#" class="text-blue-500 hover:underline">Property Inquiry</a>
                    <a href="#" class="text-blue-500 hover:underline">Contact Host</a>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>

    <hr class="border-t border-gray-300 my-8">
    <!-- Reviews Section -->
    <section class="mt-12"></section>
      <h2 class="text-2xl font-bold mb-6">Reviews <span class="text-yellow-500">★ <?php echo number_format($averageRating, 1); ?></span></h2>
      
      <!-- Review Ratings -->
      <div class="grid grid-cols-2 gap-8">
        <div class="space-y-4">
          <div class="flex justify-between text-gray-600">
            <span>Amenities</span>
            <span><?php echo number_format($ratings['amenities'] ?? 0, 1); ?></span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Communication</span>
            <span><?php echo number_format($ratings['communication'] ?? 0, 1); ?></span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Value for Money</span>
            <span><?php echo number_format($ratings['value_for_money'] ?? 0, 1); ?></span>
          </div>
        </div>
        <div class="space-y-4">
          <div class="flex justify-between text-gray-600">
            <span>Hygiene</span>
            <span><?php echo number_format($ratings['hygiene'] ?? 0, 1); ?></span>
          </div>
          <div class="flex justify-between text-gray-600">
            <span>Location of Property</span>
            <span><?php echo number_format($ratings['location'] ?? 0, 1); ?></span>
          </div>
        </div>
      </div>

      <!-- Individual Reviews -->
      <div class="mt-8 space-y-8">
        <?php foreach ($reviews as $row) { ?>
          <div class="flex space-x-4">
            <div class="h-16 w-16 bg-gray-300 rounded-full"></div>
            <div>
              <h3 class="font-bold"><?php echo htmlspecialchars($row['name']); ?></h3>
              <p class="text-gray-600 text-sm"><?php echo htmlspecialchars($row['review_date']); ?></p>
              <p class="mt-2 text-gray-600">
                <?php echo htmlspecialchars($row['comment']); ?>
              </p>
            </div>
          </div>
        <?php } ?>
      </div>

      <!-- Show All Reviews Button -->
      <div class="mt-6">
        <button class="bg-gray-200 text-gray-800 px-6 py-2 rounded-md hover:bg-gray-300">
          Show All 100 Reviews
        </button>
      </div>
    </section>

  </main>

  <!-- Footer -->
  
</div>
