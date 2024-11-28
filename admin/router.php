<?php
// index phục vụ request của admin

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new DashboardController())->dashboard(),

    // room
    'room-list' => (new RoomController())->room_list(),
    'room-add' => (new RoomController())->room_add(),
    'room-edit' => (new RoomController())->room_edit(),
    'room-delete' => (new RoomController())->room_delete(),

    'room-post-add' => (new RoomController())->room_post_add(),
    'room-post-edit' => (new RoomController())-> room_post_edit(),


    // feature 
    'feature-list' => (new FeatureController())-> feature_list(),
    'feature-add' => (new FeatureController())-> feature_add(),
    'feature-edit' => (new FeatureController())-> feature_edit(),
    'feature-delete' => (new FeatureController())-> feature_delete(),
    
    'feature-post-add' => (new FeatureController())-> feature_post_add(),
    'feature-post-edit' => (new FeatureController())-> feature_post_edit(),
        
    // room-type

    'room-type-list' => (new RoomTypeController())->room_type_list(),
    'room-type-add' => (new RoomTypeController())->room_type_add(),
    'room-type-edit' => (new RoomTypeController())->room_type_edit(),
    'room-type-delete' => (new RoomTypeController())->room_type_delete(),

    'room-type-post-add' => (new RoomTypeController())->room_type_post_add(),
    'room-type-post-edit' => (new RoomTypeController())-> room_type_post_edit(),

    
    // review 
    'review-list' => (new ReviewController())-> review_list(),
    'review-delete' => (new ReviewController())-> review_delete(),

    // Booking
    'booking-list' => (new BookingController())->booking_list(),
    'booking-add' => (new BookingController())->booking_add(),
    'booking-edit' => (new BookingController())->booking_edit(),
    'booking-delete' => (new BookingController())->booking_delete(),

    'booking-post-add' => (new BookingController())->booking_post_add(),
    'booking-post-edit' => (new BookingController())-> booking_post_edit(),

    'checkin-checkout-today' => (new BookingController())-> checkin_checkout_today(),
    'confirm-checkin' => (new BookingController())-> confirm_checkin(),
    'confirm-checkout' => (new BookingController())-> confirm_checkout(),



    // amenity

    'amenity-list' => (new AmenityController())-> amenity_list(),
    'amenity-add' => (new AmenityController())-> amenity_add(),
    'amenity-edit' => (new AmenityController())-> amenity_edit(),
    'amenity-delete' => (new AmenityController())-> amenity_delete(),

    'amenity-post-add' => (new AmenityController())-> amenity_post_add(),
    'amenity-post-edit' => (new AmenityController())-> amenity_post_edit(),
    

    
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
    'users-list' => (new UserController())->user_list(),

    //delete
    'delete-user' => (new UserController())->delete_user(),

    //update
    'update-user' => (new UserController())->update_user(),
    'post-update-user' => (new UserController())->post_update_user(),

    //create
    'create-user' => (new UserController())->create_user(),
    'post-create-user' => (new UserController())->post_create_user(),

    // booking history


};