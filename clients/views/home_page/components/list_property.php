<?php
$title = $data['title'];
$rooms = $data['rooms'];
?>

    <div class="container mx-auto ">
        <div>
            <?php $viewApp->requestComponents('home_page.components.title_section', ['title' => $title]); ?>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 gap-y-6">
            <?php foreach ($rooms as $room): ?>
                    <div class="">
                        <?php $viewApp->requestComponents('home_page.components.property_card', ['data' => $room]); ?>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>