<?php 

class PaymentController extends BaseController {
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $userModel;

    public function loadModels() {
        $this->userModel = new User();
    }

    public function payment_vnpay() {
        $data = $_GET['total_payment'];
        $this->viewApp->requestView('payment.index', ['data' => $data]);
    }
   
}
?>