<?php

$reviews =  $data

?>
<div class="container mx-auto mt-5">
    <h1 class="text-2xl font-bold mb-4">Quản lý đánh giá</h1>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 text-center border-b">ID</th>
                <th class="py-2 px-4 text-center border-b">Customer name</th>
                <th class="py-2 px-4 text-center border-b">Rating</th>
                <th class="py-2 px-4 text-center border-b">Customer Reviews</th>
                <th class="py-2 px-4 text-center border-b">Date</th>
                <th class="py-2 px-4 text-center border-b">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
            <tr>
                <td class="py-2 px-4 text-center border-b"><?php echo $review['review_id']; ?></td>
                <td class="py-2 px-4 text-center border-b">
                    <?php echo htmlspecialchars($review['user_name'] ?? 'Không xác định'); ?></td>
                <td class="py-2 px-4 text-center border-b"><?php echo $review['rating']; ?></td>
                <td class="py-2 px-4 text-center border-b">
                    <?php echo htmlspecialchars($review['comment'] ?? 'Không có nhận xét'); ?></td>
                <td class="py-2 px-4 text-center border-b">
                    <?php echo date('d/m/Y', strtotime($review['review_date'])); ?></td>
                <td class="py-2 px-4 text-center border-b">
                    <form action="<?= $route->getLocateAdmin('review-delete', ['id' => $review['review_id']]) ?>"
                        method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đánh giá này?');">
                        <button type="submit" class="text-red-500 hover:text-red-700">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>