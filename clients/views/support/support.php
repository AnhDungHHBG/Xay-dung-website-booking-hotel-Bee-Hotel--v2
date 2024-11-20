<div class="bg-gray-100">
<div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Hỗ Trợ Khách Hàng</h1>
        
        <!-- Danh sách câu hỏi thường gặp -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-3">Câu Hỏi Thường Gặp</h2>
            <div class="bg-white p-4 rounded shadow-md mb-4">
                <h3 class="font-bold">1. Làm thế nào để đặt phòng?</h3>
                <p class="text-gray-700">Bạn có thể đặt phòng trực tuyến qua trang web của chúng tôi hoặc liên hệ với chúng tôi qua điện thoại.</p>
            </div>
            <div class="bg-white p-4 rounded shadow-md mb-4">
                <h3 class="font-bold">2. Chính sách hủy phòng như thế nào?</h3>
                <p class="text-gray-700">Chính sách hủy phòng của chúng tôi cho phép bạn hủy miễn phí trong vòng 24 giờ trước khi nhận phòng.</p>
            </div>
            <!-- Thêm các câu hỏi khác ở đây -->
        </div>

        <!-- Biểu mẫu gửi yêu cầu hỗ trợ -->
        <form action="submit_support.php" method="POST" class="bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl font-semibold mb-3">Gửi yêu cầu hỗ trợ</h2>
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Tên của bạn:</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Tin nhắn:</label>
                <textarea id="message" name="message" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Gửi</button>
        </form>

        <!-- Hiển thị phản hồi từ admin -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-3">Phản hồi từ Admin</h2>
            <div class="bg-white p-4 rounded shadow-md">
                <?php
                // Giả sử bạn đã kết nối đến cơ sở dữ liệu và lấy phản hồi
                // $response = lấy phản hồi từ cơ sở dữ liệu dựa trên email hoặc ID yêu cầu
                $response = "Cảm ơn bạn đã gửi yêu cầu. Chúng tôi sẽ phản hồi sớm nhất có thể."; // Ví dụ phản hồi
                echo "<p class='text-gray-700'>$response</p>";
                ?>
            </div>
        </div>
    </div>
</div>