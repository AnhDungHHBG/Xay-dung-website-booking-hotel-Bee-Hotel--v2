<?php
// index phục vụ request của admin

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new DashboardController())->dashboard(),


    // review 
    'review-list' => (new ReviewController())-> review_list(),
    'review-delete' => (new ReviewController())-> review_delete(),

    // Booking
    'bookings-list' => (new BookingController())->booking_list(),
    'bookings-add' => (new BookingController())->booking_add(),
    'bookings-edit' => (new BookingController())->booking_edit(),
    'bookings-delete' => (new BookingController())->booking_delete(),

    'bookings-post-add' => (new BookingController())->booking_post_add(),
    'bookings-post-edit' => (new BookingController())-> booking_post_edit(),


    // 'bookings/add' => (new BookingController())->addBookings(),
    

    
    // promotions
    'promotion-list' => (new PromotionController())-> promotion_list(),
    'promotion-add' => (new PromotionController())-> promotion_add(),
    'promotion-edit' => (new PromotionController())-> promotion_edit(),
    'promotion-delete' => (new PromotionController())-> promotion_delete(),

    'promotion-post-add' => (new PromotionController())-> promotion_post_add(),
    'promotion-post-edit' => (new PromotionController())-> promotion_post_edit(),
    
    //support
    'support-list' => (new SupportController())-> support_list(),
    'support-detail' => (new SupportController())-> support_detail(),
    'support-response-post' => (new SupportController())-> support_response_post(),
    
    // notification
    'notification-list' => (new NotificationController())->list(),

    //user
    'user-list' => (new NotificationController())->list(),

};