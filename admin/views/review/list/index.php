<?php

$reviews =  $data

?>
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Quản lý đánh giá</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Tên khách hàng</th>
                <th class="py-2 px-4 border-b">Phòng</th>
                <th class="py-2 px-4 border-b">Đánh giá</th>
                <th class="py-2 px-4 border-b">Nhận xét</th>
                <th class="py-2 px-4 border-b">Ngày đánh giá</th>
                <th class="py-2 px-4 border-b">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo $review['review_id']; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($review['user_name'] ?? 'Không xác định'); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($review['room_description'] ?? 'Không xác định'); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo $review['rating']; ?></td>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($review['comment'] ?? 'Không có nhận xét'); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo date('d/m/Y', strtotime($review['review_date'])); ?></td>
                    <td class="py-2 px-4 border-b">
                        <form action="<?= $route->getLocateAdmin('review-delete', ['id' => $review['review_id']]) ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                            <button type="submit" class="text-red-500 hover:text-red-700">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
