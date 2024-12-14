<?php 

class PaymentController extends BaseController {
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $userModel;
    public $roomModel;
    public $bookingModel;
    public $paymentModel;

    public function loadModels() {
        $this->userModel = new User();
        $this->roomModel = new Room();
        $this->paymentModel = new Payment();
        $this->bookingModel = new Booking();
    }

    public function payment_vnpay() {
        $object = $this->route->form;
        $data = (array) $object;
        $user = $_SESSION['user'];
        $username = $user['name'];
        $tongtienthanhtoan = $data['amount'];
        // -----------------
            $vnp_TmnCode = "YNPS4G2J";
            $vnp_HashSecret = "EY3MOUTLJ8RBH3LJV0ZKJRP7096OP4TF";
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = 'http://localhost/du-an-1/clients/views/vnpay_result/index.php';

            // Tạo dữ liệu gửi đến VNPAY
            $vnp_Params = [
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $tongtienthanhtoan  * 100, 
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $_SERVER['REMOTE_ADDR'],
                "vnp_Locale" => "vn",
                "vnp_OrderInfo" => "Thanh toán đơn hàng từ khách $username",
                "vnp_OrderType" => "other",
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => rand(100000, 999999), 
            ];

            ksort($vnp_Params);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($vnp_Params as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $query = rtrim($query, "&"); 

            $vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

            $vnp_Params['vnp_SecureHash'] = $vnp_SecureHash;

            $vnp_Url = $vnp_Url . "?" . $query . "&vnp_SecureHash=" . $vnp_SecureHash;

            header("Location: $vnp_Url");
    }

    public function payment_onsite() {
        $object = $this->route->form;
        $array = (array) $object;
        $room_id = $_GET['room_id'];
        $user_id = $_SESSION['user']['user_id'];
        $checkBooking = $this->bookingModel->check_booking($room_id, $user_id);
        $statusRoom = 'Booked';
        $this->roomModel->update_status($room_id,$statusRoom);

        $status = 'Pending';
        $res = $this->bookingModel->create_booking($user_id, $room_id, $array, $status);
        $id = (int) $res;
        
        $statusPayment = 'Pending';
        $this->paymentModel->create_payment($id, $array,$statusPayment);

        $data = $this->bookingModel->getBookingDetail($id);
        $title = 'Booking Thành Công';
        $content = 'Bạn đã đặt phòng thành công';
        $this->paymentModel->create_notification($user_id, $title, $content );
        $this->viewApp->requestView('result_booking.index', ['data' => $data]);
        
    }
   
}
?>