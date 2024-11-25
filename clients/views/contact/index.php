
<?php
$responses = $data;
?>
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
        <form action="<?= $route->getLocateClient('contact-post') ?>" method="POST" class="bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl font-semibold mb-3">Gửi yêu cầu hỗ trợ</h2>

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Tên của bạn:</label>
                <input type="text" id="name" name="" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input  type="email" id="email" name="" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-gray-700">Tiêu đề:</label>
                    <input  type="text" id="subject" name="subject" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="message" class="block text-gray-700">Tin nhắn:</label>
                    <textarea id="message" name="message" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>

                <!-- Trường status ẩn -->
                <input type="text" name="status" value="open" hidden />

                <!-- Nút submit -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Gửi
                </button>
            </form>


        <!-- Hiển thị phản hồi từ admin -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-3">Phản hồi từ Admin</h2>
            <?php
            $ticketsGrouped = [];

            // Nhóm các phản hồi cho mỗi ticket
            foreach ($responses as $ticket) {
                $ticket_id = $ticket['ticket_id'];
                if (!isset($ticketsGrouped[$ticket_id])) {
                    // Tạo một mảng mới cho mỗi yêu cầu hỗ trợ
                    $ticketsGrouped[$ticket_id] = [
                        'ticket_subject' => $ticket['ticket_subject'],
                        'ticket_message' => $ticket['ticket_message'],
                        'responses' => []
                    ];
                }
                
                // Thêm phản hồi vào yêu cầu hỗ trợ
                $ticketsGrouped[$ticket_id]['responses'][] = [
                    'response_message' => $ticket['response_message'],
                    'response_date' => $ticket['response_date'],
                    'staff_name' => $ticket['staff_name']
                ];
            }

            // Hiển thị kết quả
                foreach ($ticketsGrouped as $ticket) {
                    // Hiển thị thông tin yêu cầu hỗ trợ
                    echo "<div class='bg-white p-4 rounded-lg shadow-md mb-6'>";
                    echo "<h2 class='text-xl font-semibold text-blue-600'>" . $ticket['ticket_subject'] . "</h2>";
                    echo "<p class='text-gray-700 mt-2'>" . $ticket['ticket_message'] . "</p>";

                    // Hiển thị các phản hồi từ admin
                    echo "<div class='mt-4'>";
                    foreach ($ticket['responses'] as $response) {
                        echo "<div class='bg-gray-100 p-3 rounded-lg mt-2'>";
                        echo "<p class='text-sm text-gray-500'><strong>Phản hồi từ: </strong>" . $response['staff_name'] . "</p>";
                        echo "<p class='text-gray-700 mt-1'>" . $response['response_message'] . "</p>";
                        echo "<p class='text-xs text-gray-400 mt-2'><strong>Ngày phản hồi: </strong>" . $response['response_date'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
                ?>

        </div>
    </div>
</div>