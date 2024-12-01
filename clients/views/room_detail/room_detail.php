<?php 
$reviews = $data['reviews'];
$room = $data['room'];
$averageRating = $data['averageRating'];
?>

<div class="bg-gray-100">

  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8">
    <!-- Image Section -->
    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 space-y-6">
          <?php 
                $images = explode(", ", $room['images']);
          ?>
            <!-- Room Main Image -->
            <div class="h-64 bg-gray-300 rounded-lg shadow-sm" style="background-image: url('<?= htmlspecialchars($images[0]) ?>'); background-size: cover; background-position: center;"></div>
            
            <!-- Thumbnail Images -->
            <div class="flex space-x-4">
                <?php
                foreach ($images as $image) {
                    echo '<div class="h-32 w-1/2 bg-gray-300 rounded-lg shadow-md" style="background-image: url(\'' . htmlspecialchars($image) . '\'); background-size: cover; background-position: center;"></div>';
                }
                ?>
            </div>
        </div>
       <!-- "More Photos" Section -->
      <div class="h-64 bg-gray-300 flex justify-center items-center text-gray-500 rounded-lg shadow-md" style="background-image: url('<?= htmlspecialchars($images[count($images) - 1]) ?>')">
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
            <h1 class="text-3xl font-semibold text-[#133E87]"> Room code: <?= htmlspecialchars($room['room_id']) ?>-<?= htmlspecialchars($room['room_type']) ?></h1>
            <p class="text-gray-600 mt-4 mr-5"><?= htmlspecialchars($room['description']) ?></p>

            <!-- Room Details -->
            <div class="flex items-center space-x-6 mt-6">
                <div class="text-gray-600 flex items-center space-x-2">
                    <h2 class="text-xl font-bold text-[#133E87]">Capacity: <?= htmlspecialchars($room['capacity']) ?> <i class="fa-solid fa-person"></i> </h2>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-semibold text-[#133E87]">Offered Amenities</h2>
                <ul class="list-disc pl-6 mt-4 text-gray-600 w-[500px]">
                    <?php
                    $feature_icons = [
                      'WiFi' => 'fas fa-wifi',
                      'TV' => 'fas fa-tv',
                      'Air Conditioner' => 'fas fa-snowflake',
                      'Mini Bar' => 'fas fa-glass-martini-alt',
                      'Balcony' => 'fas fa-sun',
                      'Bed' => 'fas fa-bed',
                      'Work desk' => 'fas fa-laptop',
                      'Wardrobe' => 'fas fa-tshirt',
                      'Hairdryer' => 'fas fa-wind'
                  ];
                  $feature_names = explode(", ", $room['feature_names']);
                 if (!empty($feature_names)) {
                  echo '<div class="grid grid-cols-2 gap-4">'; 
                  foreach ($feature_names as $feature_name) {
                      if (!empty($feature_name)) {
                          $icon = isset($feature_icons[$feature_name]) ? $feature_icons[$feature_name] : 'fas fa-check'; 
                          echo '<div class="flex items-center space-x-2">
                                  <i class="' . htmlspecialchars($icon) . ' text-yellow-500"></i>
                                  <span class="text-gray-700">' . htmlspecialchars($feature_name) . '</span>
                                </div>';
                      }
                  }
                  echo '</div>';
              } else {
                  echo '<p class="text-gray-500">Không có tiện ích nào.</p>';
              }
              ?>
                  
                </ul>

                <div class="mt-8">
                  <h2 class="text-xl font-semibold text-[#133E87]">Safety and Hygiene</h2>
                  <ul class="list-disc pl-6 mt-4 text-gray-600 grid grid-cols-2 gap-4 w-[500px]">
                    <li class="flex justify-start items-center gap-5">
                      <i class="fa-solid fa-broom"></i>
                      <span>Daily Cleaning</span>
                    </li>
                    <li class="flex justify-start items-center gap-5">
                    <i class="fa-solid fa-pump-medical"></i>
                      <span>Disinfections and Sterilizations</span>
                    </li>
                    <li class="flex justify-start items-center gap-5">
                      <i class="fa-solid fa-fire-extinguisher"></i>
                      <span>Fire Extinguishers</span>
                    </li>
                    <li class="flex justify-start items-center gap-5">
                      <i class="fa-regular fa-bell"></i>
                      <span>Smoke Detectors</span>
                    </li>
                  </ul>
               </div>
            </div>
        </div>
       
        <div >
            <div class="p-6 bg-white rounded-lg shadow-xl">
                <h2 class="text-3xl text-center  font-bold text-[#133E87]">$<?= number_format($room['price'], 2) ?> per night</h2>
               <hr class="border-t border-gray-300 my-8">

                <ul class="text-gray-600 mt-4 space-y-2">
                    <li>Short Period: $<?= number_format($room['price'], 2) ?></li>
                    <li>Medium Period: $<?= number_format($room['price'] * 1.5, 2) ?></li>
                    <li>Long Period: $<?= number_format($room['price'] * 2, 2) ?></li>
                </ul>
                <a href="<?= $route->getLocateClient('room-reserve', ['room_id' => $room['room_id']]) ?>">
                  <button class="bg-[#608BC1] text-white w-full py-3 text-lg font-bold mt-6 rounded-md hover:bg-[#395b89]">Reserve Now</button>
                </a>
                <div class="mt-4 flex space-x-4 justify-center items-center">
                    <a href="#" class="text-[#133E87] hover:underline">Property Inquiry</a>
                    <div class="w-4 flex justify-center items-center">|</div>
                    <a href="#" class="text-[#133E87] hover:underline">Contact Host</a>
                </div>
            </div>
        </div>
    </section>
    <hr class="border-t border-gray-300 my-8">

    <!-- Reviews Section -->
    <section class="mt-12">
      <h2 class="text-2xl font-semibold text-[#133E87] mb-6">Reviews <span class="text-yellow-500">★ <?php echo number_format($averageRating, 1); ?></span></h2>
      
      <!-- Review Ratings -->
      <?php
      // Giả sử $reviews chứa tất cả các đánh giá từ truy vấn trên
      foreach ($reviews as $review) {
          echo '<div class="review-item bg-white p-6 mb-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">';
          echo '<div class="flex justify-between items-center mb-4">';
          // Tên người đánh giá
          echo '<p class="text-xl font-semibold text-gray-800">' . htmlspecialchars($review['reviewer_name']) . '</p>';
          // Đánh giá sao
          echo '<div class="flex text-yellow-400">';
          for ($i = 0; $i < 5; $i++) {
              if ($i < $review['rating']) {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" stroke="currentColor"><path d="M10 15l-3.5 2l1-4.5L2 8h4.5L10 3l1.5 5.5H16l-5.5 4.5L10 15z" /></svg>';
              } else {
                  echo '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 20 20"><path d="M10 15l-3.5 2l1-4.5L2 8h4.5L10 3l1.5 5.5H16l-5.5 4.5L10 15z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" /></svg>';
              }
          }
          echo '</div>';
          echo '</div>';

          // Nội dung đánh giá
          echo '<p class="text-gray-700 text-base mb-4">' . htmlspecialchars($review['comment']) . '</p>';

          // Ngày đánh giá
          echo '<p class="text-sm text-gray-500"><small>Ngày đánh giá: ' . date('d-m-Y', strtotime($review['review_date'])) . '</small></p>';
          echo '</div>';
      }
      ?>

    
    <hr class="border-t border-gray-300 my-8">
    </section>

  </main>

  <!-- Footer -->
  
</div>
