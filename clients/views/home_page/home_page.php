<?php
    $tops = $data['top'];
    $lastest = $data['lastest'] ;
    $room_lastest = [
        'title' => 'Latest on the Property Listing',
        'rooms' => $lastest
    ];

    $room_top = [
        'title' => 'Featured Properties on our Listing',
        'rooms' => $tops
    ]

   


?>
<div>
    <!-- banner -->
    <div class="w-full flex justify-center items-center h-[600px] bg-[#F5F5F5]">
        <span class="text-center">Banner</span>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_lastest, ['key' => 'carousel1'])]); ?>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_lastest, ['key' => 'carousel2'])]); ?>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_lastest, ['key' => 'carousel3'])]); ?>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.banner_section') ?>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_property', ['data' => $room_top ]); ?>
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.banner_section') ?>
    </div>


    <div>
        <div class="container mx-auto flex">
            <div class="flex-2">
                <?php $viewApp->requestComponents('home_page.components.title_section', ['title' => 'Discover More About Property Rental']) ?>    
                <span>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</span>   
                <button class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Discover More</button>      
            </div>
            <div class="flex-1">

            </div>
        </div>
    </div>
</div>




































<!-- pop up notification promotion -->
<?php
// fake data
$promotion = [
    'promotion_id' => 1,
    'promotion_name' => 'Giảm giá mùa hè',
    'discount_rate' => 20.00,
    'start_date' => '2023-12-01',
    'end_date' => '2023-12-31'
];
?>
<div id="promotion-popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-500 ease-out">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6 relative transform transition-transform duration-500 ease-out scale-90 opacity-0">
        <button id="close-popup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-2xl font-bold mb-4"><?= htmlspecialchars($promotion['promotion_name']) ?></h2>
        <p class="text-gray-700 mb-2">Tỷ lệ giảm giá: <span class="font-semibold"><?= htmlspecialchars($promotion['discount_rate']) ?>%</span></p>
        <p class="text-gray-700 mb-4">Thời gian: <span class="font-semibold"><?= htmlspecialchars($promotion['start_date']) ?></span> đến <span class="font-semibold"><?= htmlspecialchars($promotion['end_date']) ?></span></p>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
            Xem chi tiết
        </button>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('promotion-popup');
    const closePopup = document.getElementById('close-popup');
    const popupContent = popup.querySelector('div');

    // Hiển thị popup với hiệu ứng
    setTimeout(() => {
        popup.classList.remove('hidden');
        popup.classList.add('opacity-100');
        popupContent.classList.add('scale-100', 'opacity-100');
    }, 500); 

    closePopup.addEventListener('click', function() {
        popup.classList.add('hidden');
        popup.classList.remove('opacity-100');
        popupContent.classList.remove('scale-100', 'opacity-100');
    });

    popup.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.classList.add('hidden');
            popup.classList.remove('opacity-100');
            popupContent.classList.remove('scale-100', 'opacity-100');
        }
    });
});
</script>