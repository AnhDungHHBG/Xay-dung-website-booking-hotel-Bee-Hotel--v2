<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Danh sách Thông Báo</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Tiêu đề</th>
                <th class="py-2 px-4 border-b">Nội dung</th>
                <th class="py-2 px-4 border-b">Ngày tạo</th>
                <th class="py-2 px-4 border-b">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notifications as $notification): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo $notification['notification_id']; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($notification['title']); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($notification['content']); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo date('d/m/Y H:i', strtotime($notification['created_at'])); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo $notification['is_read'] ? 'Đã đọc' : 'Chưa đọc'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>