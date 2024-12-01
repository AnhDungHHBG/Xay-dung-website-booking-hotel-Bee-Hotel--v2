<?php
// checkout.php

// $totalAmount = $_SESSION['total'];
$totalAmount = $data;

// VNPAY cấu hình (lấy thông tin từ tài khoản VNPAY)
$vnp_TmnCode = "VNPAY_TMN_CODE";  // Mã Merchant (do VNPAY cấp)
$vnp_HashSecret = "VNPAY_HASH_SECRET";  // Secret Key (do VNPAY cấp)
$vnp_ApiUrl = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";  // Địa chỉ API VNPAY (sandbox cho thử nghiệm)

// Giả sử tỷ giá USD sang VND là 1 USD = 23,000 VND (tỷ giá thực tế có thể thay đổi)
$usdToVndRate = 23000;
$vnp_Amount = $totalAmount * $usdToVndRate; // Tính tiền theo đơn vị đồng VND

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount, // Số tiền đã quy đổi sang VND
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date("YmdHis"),
    "vnp_CurrCode" => "USD",  // Sử dụng USD
    "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],  // Địa chỉ IP người dùng
    "vnp_Locale" => "vn",  // Ngôn ngữ: "vn" cho tiếng Việt
    "vnp_OrderInfo" => "Thanh toán cho đơn đặt phòng khách sạn",  // Thông tin đơn hàng
    "vnp_OrderType" => "billpayment",
    "vnp_ReturnUrl" => "http://localhost/du-an-1/clients/views/vnpay_result/index.php",  // URL sau khi thanh toán thành công
    "vnp_TxnRef" => time(),  // Mã giao dịch duy nhất
);

// Tạo mã hash bảo mật để bảo vệ dữ liệu
ksort($inputData);
$hashData = http_build_query($inputData);
$vnp_SecureHash = hash_hmac('sha256', $hashData, $vnp_HashSecret);

// Thêm mã hash vào dữ liệu gửi đi
$inputData['vnp_SecureHash'] = $vnp_SecureHash;

// Chuyển đổi thành chuỗi query string để gửi đi
$query = http_build_query($inputData);

// URL đầy đủ để gửi đến VNPAY
$vnp_Url = $vnp_ApiUrl . "?" . $query;
?>

<!-- Form ẩn chuyển hướng người dùng sang VNPAY -->
<form action="<?php echo $vnp_Url; ?>" method="post" name="redirect">
    <input type="submit" value="Chuyển đến VNPAY" class="hidden">
</form>

<script type="text/javascript">
document.forms['redirect'].submit(); // Tự động submit form để chuyển hướng đến VNPAY
</script>