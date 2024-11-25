<?php
$tickets =$data;
?>
<div class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Danh sách yêu cầu hỗ trợ</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-lg rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Tên người gửi</th>
                        <th class="py-2 px-4 text-left">Tiêu đề</th>
                        <th class="py-2 px-4 text-left">Trạng thái</th>
                        <th class="py-2 px-4 text-left">Ngày tạo</th>
                        <th class="py-2 px-4 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-2 px-4"><?= $ticket['ticket_id']; ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($ticket['name']); ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($ticket['subject']); ?></td>
                            <td class="py-2 px-4">
                                <?= $ticket['status'] === 'Open' 
                                    ? '<span class="text-green-600 font-bold">Open</span>' 
                                    : '<span class="text-red-600 font-bold">Closed</span>'; ?>
                            </td>
                            <td class="py-2 px-4"><?= $ticket['created_at']; ?></td>
                            <td class="py-2 px-4 text-center">
                                <a href="<?= $route->getLocateAdmin('support-detail', ['id' => $ticket['ticket_id']]) ?>" 
                                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Xem chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
