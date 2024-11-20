<?php 
$reviews = $data['reviews'];
// $room = $data['room'];
$averageRating = $data['averageRating'];
?>

<div class="bg-gray-100">
  
  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8">
    <!-- Image Section -->
    <div class="grid grid-cols-3 gap-4">
      <div class="col-span-2 space-y-4">
        <div class="h-64 bg-gray-300"></div>
        <div class="flex space-x-4">
          <div class="h-32 w-1/2 bg-gray-300"></div>
          <div class="h-32 w-1/2 bg-gray-300"></div>
        </div>
      </div>
      <div class="h-64 bg-gray-300 flex justify-center items-center text-gray-500">+2 More Photos</div>
    </div>

    <!-- Property Info -->
    <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="md:col-span-2">
        <h1 class="text-2xl font-bold">Well Furnished Apartment</h1>
        <p class="text-gray-600">100 Street Example, LA, USA</p>
        <div class="flex items-center space-x-6 mt-4">
          <div class="text-gray-600 flex items-center space-x-2">
            <span class="text-lg font-semibold">3 Bedrooms</span>
          </div>
          <div class="text-gray-600 flex items-center space-x-2">
            <span class="text-lg font-semibold">2 Bathrooms</span>
          </div>
          <div class="text-gray-600 flex items-center space-x-2">
            <span class="text-lg font-semibold">5 Car/Bike Spaces</span>
          </div>
          <div class="text-gray-600 flex items-center space-x-2">
            <span class="text-lg font-semibold">No Pets Allowed</span>
          </div>
        </div>
        <p class="mt-4 text-gray-600">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe inventore fugiat voluptates, optio distinctio similique a cumque.
        </p>

        <!-- Amenities -->
        <div class="mt-6">
          <h2 class="text-lg font-semibold">Offered Amenities</h2>
          <div class="grid grid-cols-2 gap-4 mt-4 text-gray-600">
            <span>Kitchen</span>
            <span>Air Conditioner</span>
            <span>Television with Netflix</span>
            <span>Free Wireless Internet</span>
          </div>
        </div>
      </div>

      <!-- Price Section -->
      <div>
        <div class="p-6 bg-white rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-800">$1000 - $2000</h2>
          <ul class="text-gray-600 mt-4 space-y-2">
            <li>Short Period: $1000</li>
            <li>Medium Period: $1500</li>
            <li>Long Period: $2000</li>
          </ul>
          <button class="bg-blue-600 text-white w-full py-2 mt-4 rounded-md">Reserve Now</button>
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
