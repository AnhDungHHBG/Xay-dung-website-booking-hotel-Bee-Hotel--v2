

<?php 

class RoomDetailController
extends BaseController
{
    public function loadModels() {}

    public function index() {
     
        $this->viewApp->requestView('room_detail.room_detail' );
    }
}