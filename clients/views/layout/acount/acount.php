<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <!-- Header -->
  <header class="bg-white shadow">
    <div class="container mx-auto flex items-center justify-between px-4 py-4">
      <div class="text-lg font-bold">LOGO</div>
      <nav class="flex gap-4 text-sm">
        <a href="#" class="text-gray-600 hover:text-black">Find a Property</a>
        <a href="#" class="text-gray-600 hover:text-black">Share Stories</a>
        <a href="#" class="text-gray-600 hover:text-black">Rental Guides</a>
        <a href="#" class="text-gray-600 hover:text-black">Download Mobile App</a>
        <button class="px-4 py-2 bg-black text-white rounded">Become a Host</button>
      </nav>
    </div>
  </header>

  <!-- Profile Section -->
  <main class="container mx-auto px-4 py-8">
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex gap-8">
        <!-- Left Section -->
        <div class="w-1/3 text-center">
          <div class="bg-gray-200 h-32 w-32 mx-auto rounded-full flex items-center justify-center">
            <span class="text-gray-500">Upload a Photo</span>
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
        <div class="flex-1">
          <h1 class="text-2xl font-semibold">Hello, John Doe</h1>
          <p class="text-gray-500 mt-1">Joined in 2021</p>
          <button class="mt-4 px-4 py-2 border border-gray-300 rounded text-gray-700">Edit Profile</button>
          <div class="mt-6 text-gray-600">
            <p class="text-lg">0 Reviews</p>
            <p class="mt-2 text-sm">Reviewed by You</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white py-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Logo Section -->
        <div>
          <div class="text-lg font-bold">LOGO</div>
          <p class="text-sm text-gray-600 mt-2">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
          </p>
        </div>
        <!-- Links -->
        <div>
          <p class="font-semibold mb-4">COMPANY</p>
          <ul class="text-sm text-gray-600 space-y-2">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Legal Information</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Blogs</a></li>
          </ul>
        </div>
        <div>
          <p class="font-semibold mb-4">HELP CENTER</p>
          <ul class="text-sm text-gray-600 space-y-2">
            <li><a href="#">Find a Property</a></li>
            <li><a href="#">How to Host?</a></li>
            <li><a href="#">Why Us?</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
        <div>
          <p class="font-semibold mb-4">CONTACT INFO</p>
          <ul class="text-sm text-gray-600 space-y-2">
            <li>Phone: 1234567890</li>
            <li>Email: company@email.com</li>
            <li>Location: 100 Smart Street, LA, USA</li>
          </ul>
          <div class="flex gap-4 mt-4">
            <a href="#" class="text-gray-600">FB</a>
            <a href="#" class="text-gray-600">TW</a>
            <a href="#" class="text-gray-600">LN</a>
          </div>
        </div>
      </div>
      <div class="mt-8 text-sm text-gray-500 text-center">
        © 2022 thecreation.design | All rights reserved | Created with love by thecreation.design
      </div>
    </div>
  </footer>
</body>
</html>
