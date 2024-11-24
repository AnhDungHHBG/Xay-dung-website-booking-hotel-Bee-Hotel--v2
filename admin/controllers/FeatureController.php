<?php 

class FeatureController extends BaseController
{
    public $featureModel;
    public function loadModels() {
        $this->featureModel = new Feature();
    }

    public function feature_list() {
        $data = $this->featureModel->allTable();
        $this->viewApp->requestView('feature.list.index', ['data' => $data]);
    }
    public function feature_add(){
        $this->viewApp->requestView('feature.add.index');
    }
    public function feature_delete(){
        $id = $_GET['id'];
        $this->featureModel->delete_feature($id);
        $this->route->redirectAdmin('feature-list');
    }
    public function feature_post_add(){
        $data = $this->route->form;
        $this->featureModel->insertTable($data);
        $this->route->redirectAdmin('feature-list');
    }

    public function feature_edit(){
        $id = $_GET['id'];
        $data = $this->featureModel->findIdTable($id);
    
        $this->viewApp->requestView('feature.edit.index', ['data' => $data]);

    } 
    public function feature_post_edit(){
        $id = $_GET['id'];
        $data = $this->route->form;
        $this->featureModel->updateIdTable($data, $id);
        $this->route->redirectAdmin('feature-list');

    }
}