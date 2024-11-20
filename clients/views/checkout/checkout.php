
<div class="bg-gray-100">
  <div class="flex justify-center items-center min-h-screen">
    <form 
      action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
      method="POST" 
      class="w-full max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8"
    >
      <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Thanh Toán</h2>

      <!-- Tên chủ thẻ -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="cardholder-name">
          Tên chủ thẻ
        </label>
        <input
          id="cardholder-name"
          name="cardholderName"
          type="text"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>

      <!-- Số thẻ -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="card-number">
          Số thẻ
        </label>
        <input
          id="card-number"
          name="cardNumber"
          type="text"
          maxlength="16"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="XXXX XXXX XXXX XXXX"
          required
        />
      </div>

      <!-- Ngày hết hạn -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="expiry-date">
          Ngày hết hạn
        </label>
        <input
          id="expiry-date"
          name="expiryDate"
          type="month"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required
        />
      </div>

      <!-- Mã CVV -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="cvv">
          Mã CVV
        </label>
        <input
          id="cvv"
          name="cvv"
          type="text"
          maxlength="3"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="XXX"
          required
        />
      </div>

      <!-- Địa chỉ thanh toán -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="billing-address">
          Địa chỉ thanh toán
        </label>
        <textarea
          id="billing-address"
          name="billingAddress"
          rows="3"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          placeholder="Nhập địa chỉ của bạn"
        ></textarea>
      </div>

      <!-- Nút bấm -->
      <div class="flex items-center justify-between">
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Thanh toán
        </button>
        <button
          type="reset"
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
        >
          Hủy
        </button>
      </div>
    </form>
  </div>

  <?php
  // Xử lý dữ liệu khi form được gửi
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardholderName = $_POST['cardholderName'];
    $cardNumber = $_POST['cardNumber'];
    $expiryDate = $_POST['expiryDate'];
    $cvv = $_POST['cvv'];
    $billingAddress = $_POST['billingAddress'];

    echo "<div class='mt-8 text-center'>";
    echo "<h3 class='text-xl font-bold'>Thông tin thanh toán:</h3>";
    echo "<p>Tên chủ thẻ: $cardholderName</p>";
    echo "<p>Số thẻ: **** **** **** " . substr($cardNumber, -4) . "</p>";
    echo "<p>Ngày hết hạn: $expiryDate</p>";
    echo "<p>CVV: ***</p>";
    echo "<p>Địa chỉ thanh toán: $billingAddress</p>";
    echo "</div>";
  }
  ?>
</div>

