<?php
// index phục vụ request của người dùng

// kiểm tra act và điều hướng tới các controller phù hợp
match ($route->getAct()) {
    '/' => (new HomeController())->index(),
    'login' => (new LoginController())->index(),
    'login-post' => (new LoginController())->login_post(),
    'signup' => (new SignupController())->index(),
    'signup-post' => (new SignupController())->signup_post()
};