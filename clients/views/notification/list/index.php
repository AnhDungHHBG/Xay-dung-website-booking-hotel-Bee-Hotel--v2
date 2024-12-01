<?php 
$notifications = $data;
?>
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Danh sách Thông Báo</h1>
    <div class="space-y-4">
        <?php if (is_array($notifications) && count($notifications) > 0): ?>
        <?php foreach ($notifications as $notification): ?>
        <div class="bg-white shadow-md rounded-lg p-4 flex flex-col">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($notification['title'] ?? 'N/A'); ?></h2>
                <div class="gap-5">
                    <span
                        class="text-sm text-gray-500"><?php echo date('d/m/Y H:i', strtotime($notification['created_at'] ?? '')); ?></span>
                    <div>
                        <?php
                                    $search = "checkout";
                                    if (strpos($notification['title'] , $search) !== false) {
                                    ?>
                        <a href="<?= $route->getLocateClient('review-now')?>"
                            class="inline-block px-6 py-3 bg-slate-500 text-white font-semibold text-lg rounded-lg shadow-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all duration-300">
                            <span>Đánh giá ngay</span>
                        </a>

                        <?php
                                } 
                            ?>
                    </div>
                </div>
            </div>
            <p class="mt-2 text-gray-700"><?php echo htmlspecialchars($notification['content'] ?? 'N/A'); ?></p>
            <div class="mt-2">
                <span
                    class="text-sm <?php echo ($notification['is_read'] ?? false) ? 'text-green-500' : 'text-red-500'; ?>">
                    <?php echo ($notification['is_read'] ?? false) ? 'Đã đọc' : 'Chưa đọc'; ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="bg-gray-100 p-4 rounded-lg">
            <p class="text-gray-600">Không có thông báo nào.</p>
        </div>
        <?php endif; ?>
    </div>
</div>