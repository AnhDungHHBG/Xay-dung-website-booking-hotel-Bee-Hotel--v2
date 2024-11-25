
<?php 

class BookingController extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('booking.booking' );
    }
}