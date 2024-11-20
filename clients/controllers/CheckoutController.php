

<?php 

class CheckoutController extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('checkout.checkout' );
    }
}