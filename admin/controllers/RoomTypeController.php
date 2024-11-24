<?php 

class RoomTypeController extends BaseController
{
    public $roomTypeModel;
    public function loadModels() {
        $this->roomTypeModel = new RoomType();
    }
    public function room_type_list() {
        $data = $this->roomTypeModel->allTable();
        $this->viewApp->requestView('roomtype.list.index', ['data' => $data]);
    }
    public function room_type_delete(){
        $id = $_GET['id'];
        $this->roomTypeModel->removeIdTable($id);
        $this->route->redirectAdmin('room-type-list');
    }
    public function room_type_edit(){
        $id = $_GET['id'];
        $data = $this->roomTypeModel->findIdTable($id);
        $this->viewApp->requestView('roomtype.edit.index', ['data' => $data]);
    }
    public function room_type_post_edit(){
        $id = $_GET['id'];
        $data = $this->route->form;
        $this->roomTypeModel->updateIdTable($data, $id);
        $this->route->redirectAdmin('room-type-list');

    }
    public function room_type_add(){
        $this->viewApp->requestView('roomtype.add.index');
    }
    public function room_type_post_add(){
        $data = $this->route->form;
        $this->roomTypeModel->insertTable( $data);
        $this->route->redirectAdmin('room-type-list');

    }
}