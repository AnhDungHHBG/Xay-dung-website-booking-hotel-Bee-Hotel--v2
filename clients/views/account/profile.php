<?php
$name = $_SESSION['user']['name'];
$email = $_SESSION['user']['email'];
if (isset($_SESSION['user']['created_at'])) {
    $createdAt = $_SESSION['user']['created_at'];
} else {
    // echo "Key 'created_at' không tồn tại trong session.";
}
?>

<!-- Profile Section -->
<div class="container mx-auto px-4 py-8">
  <div class="bg-white shadow rounded-lg p-6">
    <div class="flex gap-8">
      <!-- Left Section -->
      <div class="w-1/3 text-center">
        <div class="bg-gray-200 h-32 w-32 mx-auto rounded-full flex items-center justify-center">
          <!-- Avatar placeholder or image can go here -->
        </div>
        <div class="mt-4 text-gray-600">
          <p class="text-lg font-semibold">Identity Verification</p>
          <p class="text-sm mt-2">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          </p>
          <div class="mt-4 text-sm text-gray-700">
            <p class="flex items-center gap-2">
              <span>✔</span>Email Confirmed
            </p>
            <p class="flex items-center gap-2">
              <span>✔</span>Mobile Confirmed
            </p>
          </div>
        </div>
      </div>

      <!-- Right Section -->
       <?php
      if (isset($_SESSION['user'])) {
        ?>
          <div class="flex-1">
            <h1 class="text-2xl font-semibold">Hello <?php echo $name ?></h1>
            <!-- <p class="text-gray-500 mt-1">Joined in <?php echo $createdAt ?></p> -->
            
            <!-- Edit Profile Button -->
            <button class="mt-4 px-4 py-2 border border-gray-300 rounded text-gray-700" href="<?= $route->getLocateClient('editprofile') ?>">Edit Profile</button>
            
            <!-- History Booking Button -->
            <a href="<?= $route->getLocateClient('booking-history') ?>" class="mt-4 ml-4 px-4 py-2 border border-gray-300 rounded text-gray-700">
                Lịch sử Đặt Phòng
            </a>

            <div class="mt-6 text-gray-600">
              <p class="text-lg">0 Reviews</p>
              <p class="mt-2 text-sm">Reviewed by You</p>
            </div>
        <?php
      } else {
        $this->route->redirectClient('login');
      }
      ?>
      </div>
    </div>
  </div>
</div>
