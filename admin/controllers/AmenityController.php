<?php 

class AmenityController extends BaseController
{
    public $amenityModel;
    public function loadModels() {
        $this->amenityModel = new Amenity();
    }

    public function amenity_list() {
        $data = $this->amenityModel->getAllAmenities();
        $this->viewApp->requestView('amenity.list.index', ['data' => $data]);
    }
    public function amenity_add(){
        $this->viewApp->requestView('amenity.add.index');
    }
    public function amenity_delete(){
        $id = $_GET['id'];
        $this->amenityModel->deleteAmenity($id);
        $this->route->redirectAdmin('amenity-list');
    }
    public function amenity_post_add(){
        $data = (array) $this->route->form; 
        $this->amenityModel->addAmenity($data);
        $this->route->redirectAdmin('amenity-list');
    }

    public function amenity_edit(){
        $id = $_GET['id'];
        $data = $this->amenityModel->getAllAmenitiesById($id);
        $this->viewApp->requestView('amenity.edit.index', ['data' => $data]);

    } 
    public function amenity_post_edit(){
        $id = $_GET['id'];
        $data = (array) $this->route->form; 

        $this->amenityModel->updateAmenity($id, $data);
        $this->route->redirectAdmin('amenity-list');
        $this->route->redirectAdmin('amenity-list');


    }
}