<?php
// vnpay_return.php

session_start();

$vnp_HashSecret = "VNPAY_HASH_SECRET";  // Secret Key của bạn
$vnp_TmnCode = "VNPAY_TMN_CODE";  // Mã Merchant của bạn

// Lấy dữ liệu trả về từ VNPAY
$vnp_ResponseCode = $_GET['vnp_ResponseCode'];
$vnp_TxnRef = $_GET['vnp_TxnRef'];
$vnp_Amount = $_GET['vnp_Amount'] / 100; // VNPAY gửi số tiền theo đơn vị đồng
$vnp_SecureHash = $_GET['vnp_SecureHash'];

// Kiểm tra mã giao dịch và mã bảo mật
$inputData = $_GET;
unset($inputData['vnp_SecureHash']); // Loại bỏ tham số SecureHash khỏi dữ liệu tính hash
ksort($inputData);
$hashData = http_build_query($inputData);
$secureHash = hash_hmac('sha256', $hashData, $vnp_HashSecret);

if ($vnp_SecureHash == $secureHash) {
    // Nếu hash hợp lệ, kiểm tra mã phản hồi của giao dịch
    if ($vnp_ResponseCode == '00') {
        // Thanh toán thành công
        echo "Thanh toán thành công. Mã giao dịch: $vnp_TxnRef, Số tiền: $vnp_Amount VND";
        // Bạn có thể thêm bước lưu trữ kết quả vào cơ sở dữ liệu và gửi email cho người dùng
    } else {
        // Thanh toán thất bại
        echo "Thanh toán thất bại. Mã giao dịch: $vnp_TxnRef";
    }
} else {
    echo "Dữ liệu trả về không hợp lệ.";
}

?>