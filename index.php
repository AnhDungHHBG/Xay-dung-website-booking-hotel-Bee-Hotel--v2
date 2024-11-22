<?php
// index phục vụ request của người dùng

// nạp core vào
require_once './commons/core.php';

// khởi tạo các thành phần của ứng dụng
$coreApp = new CoreApp();

// khởi tạo global đối tượng view
$viewApp = new BaseView();

// khởi tạo global đối tượng route
$route = new Route();

// Khởi tạo global đối tượng auth
$auth = new Auth();

// Kiểm tra xem có phải là trang admin không
if ($route->isAdminPage) {
    $coreApp->initApp('admin');
} else {
    // khởi tạo các thành phần của clients
    $coreApp->initApp('clients');
}