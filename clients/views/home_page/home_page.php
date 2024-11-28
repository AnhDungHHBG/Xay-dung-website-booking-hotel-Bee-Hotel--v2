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
        <img class="w-full h-full object-cover" src="uploads/banner/banner.png" alt="">
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_lastest, ['key' => 'carousel1'])]); ?>
      
    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_top, ['key' => 'carousel2'])]); ?>
    </div>
    <div class="container mx-auto my-8 bg-gradient-to-r from-[#133E87] via-[#608BC1] to-[#CBDCEB] text-white h-[400px] rounded-lg shadow-xl flex justify-between items-center px-10">
        <!-- Phần nội dung bên trái -->
        <div class="max-w-lg">
            <h1 class="text-5xl font-bold text-white mb-4">
                Book Your Dream Stay
            </h1>
            <p class="text-lg text-[#CBDCEB] mb-6">
                Enjoy luxurious hotels, exclusive offers, and seamless booking experiences.
            </p>
            <button class="bg-white text-[#133E87] font-semibold px-6 py-3 rounded-full hover:bg-[#CBDCEB] hover:text-white transition duration-300">
                Start Booking
            </button>
        </div>
        <!-- Phần trang trí hoặc hình ảnh bên phải -->
        <div class="hidden lg:block">
            <div class="text-[150px] font-extrabold text-white opacity-10">
                HOTEL
            </div>
        </div>
    </div>


    </div>
    <div>
        <?php $viewApp->requestComponents('home_page.components.list_card', ['data' => array_merge($room_top, ['key' => 'carousel2'])]); ?>
    </div>
    <div class="container mx-auto my-16 bg-gradient-to-r from-[#608BC1] via-[#CBDCEB] to-white text-[#133E87] h-[400px] rounded-2xl shadow-2xl flex items-center justify-between px-12 py-8">
    <!-- Nội dung bên trái -->
    <div class="max-w-lg">
            <h2 class="text-5xl font-semibold text-white mb-6">
                Special Offer for This Season!
            </h2>
            <p class="text-xl text-white mb-6">
                Book your stay now and get up to <span class="font-semibold text-[#608BC1]">30% OFF</span> on selected hotels.
            </p>
            <button class="bg-[#133E87] text-white font-semibold px-8 py-4 rounded-full hover:bg-[#608BC1] transition-all duration-300">
                Explore Deals
            </button>
        </div>

        <!-- Phần trang trí bên phải -->
        <div class=" block w-[250px] h-[250px] bg-[#133E87] rounded-full flex items-center justify-center shadow-xl transition-all duration-300 hover:scale-110">
            <span class="text-white text-4xl font-bold ">30% OFF</span>
        </div>
    </div>




    <<div class="bg-white text-gray-800 py-16 mt-16 border-t-4 ">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <!-- Left Section: Title, Description, and Buttons -->
        <div class="flex-2 text-center md:text-left">
            <?php $viewApp->requestComponents('home_page.components.title_section', ['title' => 'Explore Our Premium Hotel Stays']) ?>
            <span class="text-gray-600 mt-4 block">
                Discover the best hotels for your stay, from luxurious resorts to budget-friendly options. Enjoy top-notch amenities, fantastic locations, and seamless booking experiences. Whether you're traveling for business or leisure, we have a hotel for every need.
            </span>   
            
            <!-- Button Section -->
            <div class="mt-6">
                <button class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Ask A Question</button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Find A Hotel</button>
            </div>

            <!-- Discover More Button -->
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6">Discover More</button>
        </div>
        
        <!-- Right Section: Image -->
        <div class="flex-1 mt-8 md:mt-0">
            <!-- Replace with an image related to hotel booking, such as a hotel room or a cityscape -->
            <img src="uploads/banner/image.png" alt="Hotel Image" class="w-full rounded-lg shadow-lg">
        </div>
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