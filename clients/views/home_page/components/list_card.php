<?php
$title = $data['title'];
$rooms = $data['rooms'];
$carouselKey = $data['key']; 
?>

<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-8">

        <div>
            <?php $viewApp->requestComponents('home_page.components.title_section', ['title' => $title]); ?>
        </div>
       
        <div class="flex gap-4">
            <button class="listing-prev-<?php echo $carouselKey; ?> w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-100 transition-colors">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="listing-next-<?php echo $carouselKey; ?> w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 hover:bg-gray-100 transition-colors">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="swiper listingSwiper-<?php echo $carouselKey; ?> w-full overflow-hidden">
        <div class="swiper-wrapper">
            <?php foreach ($rooms as $room): ?>
                <div class="swiper-slide">
                    <?php $viewApp->requestComponents('home_page.components.card', ['data' => $room]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const swiper<?php echo $carouselKey; ?> = new Swiper('.listingSwiper-<?php echo $carouselKey; ?>', {
        slidesPerView: 4,
        spaceBetween: 16,
        navigation: {
            nextEl: '.listing-next-<?php echo $carouselKey; ?>',
            prevEl: '.listing-prev-<?php echo $carouselKey; ?>',
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 12
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 14
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 16
            }
        }
    });
});
</script>

<style>
.swiper-slide {
    height: auto;
}
</style>
