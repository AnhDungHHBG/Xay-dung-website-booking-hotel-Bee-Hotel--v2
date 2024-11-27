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
        echo"111";
        die();
        $data = $_GET['total_payment'];
        $this->viewApp->requestView('payment.index', ['data' => $data]);
    }

    public function payment_onsite() {
        $data = $this->route->form;
        print_r($data);
        die();
    
    }
   
}
?>