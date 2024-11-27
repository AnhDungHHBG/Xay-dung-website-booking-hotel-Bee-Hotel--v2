<?php
// index phục vụ request của người dùng

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new HomeController())->index(),
    // support
    'support' => (new SupportController())->index(),

    // about
    'about' => (new AboutController())->about_us(),
    // contact

    'contact' => (new ContactController())->contact(),
    'contact-post' => (new ContactController())-> contact_post(),



    // booking 
    'booking-list' => (new BookingController())->booking_list(),
    'booking-history'=> (new BookingController())->booking_history(),
    'booking-detail'=> (new BookingController())->booking_detail(),
    'check-in' => (new BookingController())->check_in(),
    'check-out' => (new BookingController())->check_out(),

    // reviews
    'submit-review' => (new ReviewController())->review_post(),


    // room
    'room-detail' => (new RoomDetailController())->room_detail(),
    'room-list' => (new RoomController())->room_list(),


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

    // payment
    'payment-vnpay' =>  (new PaymentController())->payment_vnpay(),
    'payment-onsite' =>  (new PaymentController())->payment_onsite(),
};
