
<?php
$tickets = $data

?>
<div class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Danh sách phiếu hỗ trợ</h1>
        
        <div class="mb-4">
            <input type="text" id="search" placeholder="Tìm kiếm theo người dùng, trạng thái..." class="border rounded p-2">
            <button onclick="searchTickets()" class="bg-blue-500 text-white rounded p-2 ml-2">Tìm kiếm</button>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Người dùng</th>
                    <th class="py-2 px-4 border-b">Tiêu đề</th>
                    <th class="py-2 px-4 border-b">Trạng thái</th>
                    <th class="py-2 px-4 border-b">Ngày tạo</th>
                    <th class="py-2 px-4 border-b">Hành động</th>
                </tr>
            </thead>
            <tdiv>
                <?php foreach ($tickets as $ticket): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b"><?php echo $ticket['ticket_id']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $ticket['name']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $ticket['subject']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $ticket['status']; ?></td>
                        <td class="py-2 px-4 border-b"><?php echo $ticket['created_at']; ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="<?= $route->getLocateAdmin('support-detail', ['id' => $ticket['ticket_id']]) ?> " class="text-blue-500 hover:underline">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tdiv>
        </table>

      
    </div>
</div>

<script>
    function searchTickets() {
                const query = document.getElementById('search').value;
                // Thực hiện tìm kiếm (có thể sử dụng AJAX để tìm kiếm không làm mới trang)
                console.log("Tìm kiếm phiếu hỗ trợ với từ khóa: " + query);
            }
</script>