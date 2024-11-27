<?php
$user_id = $data["user_id"];
$room_id = $data["room_id"];
?>

<div class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h1 class="text-3xl font-bold text-green-600 mb-4">Cảm ơn bạn sử dụng dịch vụ của chúng tôi</h1>
            <p class="text-lg text-gray-700 mb-6">Chúng tôi rất vui khi đã được phục vụ bạn. Đơn đặt phòng của bạn đã hoàn tất check-out thành công.</p>
            <p class="text-sm text-gray-500">Chúng tôi hy vọng bạn đã có một kỳ nghỉ tuyệt vời. Nếu có bất kỳ yêu cầu nào, vui lòng liên hệ với chúng tôi qua email hoặc điện thoại.</p>

            <!-- Form Đánh Giá -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Đánh giá dịch vụ của chúng tôi</h2>
                <form method="POST"action="<?= $route->getLocateClient('submit-review') ?>"  class="space-y-4">
                    <!-- Thêm thông tin user_id và room_id -->
                    <input type="hidden" name="user_id" value="<?= $user_id ?>" />
                    <input type="hidden" name="room_id" value="<?= $room_id ?>" />
                    <input class="hidden" type="hidden" name="review_date" value="<?= date('Y-m-d H:i:s') ?>" >

                    <div>
                        <label for="rating" class="block text-sm font-medium text-gray-700">Đánh giá (1 - 5 sao)</label>
                        <select name="rating" id="rating" class="block w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="5">5 sao</option>
                            <option value="1">1 sao</option>
                            <option value="2">2 sao</option>
                            <option value="3">3 sao</option>
                            <option value="4">4 sao</option>
                        </select>
                    </div>

                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700">Nhận xét của bạn</label>
                        <textarea name="comment" id="comment" rows="4" class="block w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Chia sẻ trải nghiệm của bạn..."></textarea>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">
                        Gửi Đánh Giá
                    </button>
                </form>
            </div>

            <div class="mt-6">
                <a href="<?= $route->redirectClient('') ?>" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</div>
