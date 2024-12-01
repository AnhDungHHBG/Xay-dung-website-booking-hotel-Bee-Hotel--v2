<?php
$rooms = $data['rooms'];
$room_types = $data['room_types'];
$total_rooms = $data['total_rooms'];
$array_length = count($rooms);
$isLoadMoreDisabled = $array_length < $total_rooms;
?>

<div class="bg-gray-100 font-sans">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-4 text-gray-600">
                <a href="<?= $route->getLocateClient('room-list') ?>">
                    <span
                        class="font-medium hover:text-[#608BC1]   <?php echo empty($_GET['room_type_id']) ? 'underline  text-[#133E87]  underline-offset-4' : ''; ?>">All</span>
                </a>
                <?php foreach($room_types as $room_type): ?>
                <a
                    href="<?= $route->getLocateClient('filter-room', ['room_type_id' => $room_type['room_type_id'],'limit' => 10 ]) ?>">
                    <span
                        class=" font-medium cursor-pointer hover:text-[#608BC1] <?= isset($_GET['room_type_id']) && $_GET['room_type_id'] == $room_type['room_type_id'] ? 'underline text-[#133E87] underline-offset-4' : '' ?>">
                        <?= htmlspecialchars($room_type['type_name']) ?>
                    </span>
                </a>
                <div class="font-medium text-[#133E87]">|</div>
                <?php endforeach; ?>
            </div>
            <?php if (!empty($rooms)){ ?>
            <div>
                <span class=" text-[#133E87] font-normal"> Show <?= $array_length  ?> of <?= $total_rooms  ?> </span>
            </div>
            <?php } ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($rooms as $room): ?>
            <?php $viewApp->requestComponents('room_page.components.card', ['data' => $room]); ?>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-6 text-gray-500">
            <?php
        if ($isLoadMoreDisabled) {
            if (isset($_GET['room_type_id'])) {
                ?>
            <a
                href="<?= $route->getLocateClient('filter-room', ['room_type_id' => $_GET['room_type_id'], 'limit' => $array_length + 10 ]) ?>">
                <button
                    class="px-6 py-2 bg-[#133E87] text-white rounded hover:bg-[#608BC1] transition-colors duration-300">
                    Load More...
                </button>
            </a>
            <?php
            } else {
                ?>
            <a href="<?= $route->getLocateClient('room-list', ['limit' => $array_length + 10]) ?>">
                <button
                    class="px-6 py-2 bg-[#133E87] text-white rounded hover:bg-[#608BC1] transition-colors duration-300">
                    Load More...
                </button>
            </a>
            <?php
            }
        } 
        ?>
        </div>
    </div>
    <?php if (empty($rooms)){
        ?>
    <div class="text-center py-10">
        <span class="text-3xl font-bold animate-pulse text-gray-500">No room...</span>
    </div>
    <?php
    }
    ?>

</div>