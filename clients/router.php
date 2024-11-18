<?php
// index phục vụ request của người dùng

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new HomeController())->index(),
    'login' => (new LoginController())->index(),
    'booking' => (new BookingController())->index(),
    'checkout' => (new CheckoutController())->index(),
    'room_detail' => (new RoomDetailController())->index(),
};
