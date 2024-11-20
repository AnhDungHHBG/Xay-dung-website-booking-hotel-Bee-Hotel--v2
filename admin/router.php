<?php
// index phục vụ request của admin

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new DashboardController())->dashboard(),


    // review 
    'review-list' => (new ReviewController())-> review_list(),
    'review-delete' => (new ReviewController())-> review_delete(),
    
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

};