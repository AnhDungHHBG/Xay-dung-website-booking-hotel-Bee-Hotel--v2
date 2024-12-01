<?php 

class BookingController extends BaseController
{
   
    public $bookingModel;
    public $paymentModel;
    
    public function loadModels() {
        $this->bookingModel = new Booking();
        $this->paymentModel = new Payment();
    }

    public function booking_list() {
        $data = $this->bookingModel->allTable();
        $this->viewApp->requestView('booking.list.index', ['data' => $data]);
    }
    public function booking_add(){
        $this->viewApp->requestView('booking.add.index');
    }
    public function booking_delete(){
        $id = $_GET['id'];
        $this->bookingModel->removeIdTable($id);
        $this->route->redirectAdmin('booking-list');
    }
    public function booking_post_add(){
        $data = $this->route->form;
        $this->bookingModel->insertTable($data);
        $this->route->redirectAdmin('booking-list');
    }

    public function booking_edit(){
        $id = $_GET['id'];
        $data = $this->bookingModel->findIdTable($id);
        $this->viewApp->requestView('booking.edit.index', ['data' => $data]);

    } 
    public function booking_post_edit(){
        $id = $_GET['id'];
        $data = $this->route->form;
        $this->bookingModel->updateIdTable($data, $id);
        $this->route->redirectAdmin('booking-list');
    }

    //  managemnt booking
    public function checkin_checkout_today() {
        $res = $this->bookingModel->checkin_and_checkout();
        $data = $res;
        // print_r($data);
        // die();  

        $this->viewApp->requestView('checkin-checkout.index', ['data' => $data]);
    }
  
    public function confirm_checkin(){
        $room_id = $_GET['room_id'];
        $response = $this->bookingModel->get_booking( $room_id );
        $user_id_booking = $_GET['user_id_booking'];
        $booking_id = $response['booking_id'];
        $title = 'Bạn đã checkin thành công';
        $content = 'Cảm ơn bạn dã sử dụng dịch vụ của chúng tôi.';
        $this->bookingModel->create_notification($user_id_booking,$title, $content );
        $status = 'Checkout';
        $status = 'Checked';
        $this->bookingModel->update_status_booking( $booking_id, $status );
        $this->bookingModel->confirm_checkin($booking_id);
        $this->paymentModel->confirm_payment($booking_id);
        $this->route->redirectAdmin('checkin-checkout-today');        
    }
    public function confirm_checkout(){
        $booking_id = $_GET['booking_id'];
        $user_id_booking = $_GET['user_id_booking'];
        $title = 'Bạn đã checkout thành công';
        $content = 'Cảm ơn bạn dã sử dụng dịch vụ của chúng tôi.';
        $this->bookingModel->create_notification($user_id_booking,$title, $content );
        $status = 'Checkout';
        $this->bookingModel->update_status_booking( $booking_id, $status );
        $this->route->redirectAdmin('checkin-checkout-today');        
    }


}