<!-- Profile Section -->
  <div class="container mx-auto px-4 py-8">
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
          <form class="mt-6 space-y-4">
            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">About</label>
              <textarea id="about" rows="3" class="block w-full mt-1 p-2 border border-gray-300 rounded"></textarea>
            </div>
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
              <input id="location" type="text" class="block w-full mt-1 p-2 border border-gray-300 rounded">
            </div>
            <div>
              <label for="work" class="block text-sm font-medium text-gray-700">Work</label>
              <input id="work" type="text" class="block w-full mt-1 p-2 border border-gray-300 rounded">
            </div>
            <p class="text-sm text-gray-500">All the required user information can be added here...</p>
            <div class="flex justify-end gap-4">
              <button type="button" class="px-4 py-2 border border-gray-300 text-gray-700 rounded">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-black text-white rounded">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
