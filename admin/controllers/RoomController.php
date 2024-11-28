<?php 

class RoomController extends BaseController
{
    public $roomModel;
    public $featureModel;
    public $roomTypeModel;
    public function loadModels() {
        $this->roomModel = new Room();
        $this->featureModel = new Feature();
        $this->roomTypeModel = new RoomType();

    }
    public function room_list() {
        $data = $this->roomModel->get_rooms();
        $this->viewApp->requestView('room.list.index', ['data' => $data]);
    }
    public function room_delete(){
        $id = $_GET['id'];
        $this->roomModel->delete_room($id);
        $this->route->redirectAdmin('room-list');
    }
    public function room_edit(){
        $id = $_GET['id'];
        $features = $this->featureModel->allTable();
        $room_types = $this->roomTypeModel->allTable();
        $room = $this->roomModel->get_room_detail($id);
        $data = [
            'room_features' => $features,
            'room_types'=> $room_types,
            'room' => $room
        ];
        $this->viewApp->requestView('room.edit.index', ['data' => $data]);
    }
    public function room_post_edit(){
        $id = $_GET['id'];
        $data = $this->route->form;
        
        if (is_object($data)) {
            $data = (array) $data;
        }
        if (!empty($_FILES['images']['name'][0])) {
            $upload_result = $this->upload_images($_FILES['images']);
            if (!empty($upload_result['errors'])) {
                foreach ($upload_result['errors'] as $error) {
                    echo $error . "<br>";
                }
                exit();
            }
            $image_urls = array_column($upload_result['uploaded_files'], 'image_url');
            $data['images'] = implode(', ', $image_urls); 
        }
        $update_result = $this->roomModel->update_room($id, $data);
    
        if ($update_result['success']) {
            $this->route->redirectAdmin('room-list');
        } else {
            echo $update_result['message'];
        }
    }
    public function room_add(){
        $features = $this->featureModel->allTable();
        $room_types = $this->roomTypeModel->allTable();
        $data = [
            'features' => $features,
            'room_types'=> $room_types
        ];
        $this->viewApp->requestView('room.add.index', ['data' => $data]);
    }
    public function room_post_add(){
        $data = $this->route->form;
        if (is_object($data)) {
            $data = (array) $data;
        }
        if (!empty($_FILES['images']['name'][0])) {
            $upload_result = $this->upload_images($_FILES['images']);
            if (!empty($upload_result['errors'])) {
                foreach ($upload_result['errors'] as $error) {
                    echo $error . "<br>";
                }
                exit();
            }
            $image_urls = array_column($upload_result['uploaded_files'], 'image_url');
            $data['images'] = implode(', ', $image_urls);
        }
        $add_result = $this->roomModel->add_room($data);
        if ($add_result['success']) {
            $this->route->redirectAdmin('room-list');   
        } else {
            echo $add_result['message'];   
        }
    }
    
  
}