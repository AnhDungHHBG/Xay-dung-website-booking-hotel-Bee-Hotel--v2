<?php 

class BookingController extends BaseController
{
    public $bookingModel;

    public function loadModels() {
        $this->bookingModel = new Booking();
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
}