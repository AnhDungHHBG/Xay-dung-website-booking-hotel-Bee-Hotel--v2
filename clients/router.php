<?php
// index phục vụ request của người dùng

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new HomeController())->index(),
    'booking' => (new BookingController())->index(),
    'checkout' => (new CheckoutController())->index(),
    'room_detail' => (new RoomDetailController())->room_detail(),
    // support
    'support' => (new SupportController())->index(),
    // notification
    'notification-list' => (new NotificationController())->list(),
    // login
    'login' => (new AuthController())->index(),
    'login-post' => (new AuthController())->login_post(),
    'signup' => (new SignupController())->index(),
    'signup-post' => (new SignupController())->signup_post(),
    //profile
    'profile' => (new ProfileController())->index(),
    //logout
    'logout' => (new AuthController())->logout(),
    //admin
    'admin-manager' => (new AuthController())->admin_page(),
};
