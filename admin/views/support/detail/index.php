<?php 
$ticket = $data["ticket"];
$responses = $data["responses"];
$user_id = $_SESSION['user']['user_id'];
$currentUserId = $user_id;
;?>
<div class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Chi tiết phiếu hỗ trợ</h1>
        
        <div class="bg-white p-4 rounded shadow mb-4">
            <h2 class="text-lg font-semibold">Thông tin phiếu hỗ trợ</h2>
            <p><strong>ID:</strong> <?php echo $ticket['ticket_id']; ?></p>
            <p><strong>Người dùng:</strong> <?php echo $ticket['user_name']; ?></p>
            <p><strong>Tiêu đề:</strong> <?php echo $ticket['subject']; ?></p>
            <p><strong>Nội dung:</strong> <?php echo $ticket['message']; ?></p>
            <p><strong>Trạng thái:</strong> <?php echo $ticket['status']; ?></p>
            <p><strong>Ngày tạo:</strong> <?php echo $ticket['created_at']; ?></p>
        </div>

        <div class="bg-white p-4 rounded shadow mb-4">
            <h2 class="text-lg font-semibold">Lịch sử phản hồi</h2>
            <ul class="list-disc pl-5">
                <?php if (!empty($responses)): ?>
                    <?php foreach ($responses as $response): ?>
                        <li>
                            <strong><?php echo $response['created_at']; ?>:</strong> <?php echo $response['message']; ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>Không có phản hồi nào.</li>
                <?php endif; ?>
            </ul>
        </div>

      
        <div class="bg-white p-4 rounded shadow mb-4">
            <h2 class="text-lg font-semibold">Gửi phản hồi</h2>
            <form action="<?= $route->getLocateAdmin('support-response-post') ?> " method="POST">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                <input type="hidden" name="staff_id" value="<?php echo $currentUserId; ?>">
                <textarea name="response_message" required class="border rounded p-2 w-full" placeholder="Nhập phản hồi..."></textarea>
                <button type="submit" class="bg-blue-500 text-white rounded p-2 mt-2">Gửi phản hồi</button>
            </form>
        </div>
        <div class="bg-white p-4 rounded shadow mb-4">
            <h2 class="text-lg font-semibold">Cập nhật trạng thái</h2>
            <form action="update_status.php" method="POST">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket['ticket_id']; ?>">
                <select name="status" class="border rounded p-2 w-full">
                    <option value="Đang xử lý" <?php echo $ticket['status'] == 'Đang xử lý' ? 'selected' : ''; ?>>Đang xử lý</option>
                    <option value="Đã giải quyết" <?php echo $ticket['status'] == 'Đã giải quyết' ? 'selected' : ''; ?>>Đã giải quyết</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white rounded p-2 mt-2">Cập nhật trạng thái</button>
            </form>
        </div>
    </div>
</div>