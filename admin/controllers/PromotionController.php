<?php 

class PromotionController extends BaseController
{
    public $promotionModel;
    public function loadModels() {
        $this->promotionModel = new Promotion();
    }

    public function promotion_list() {
        $data = $this->promotionModel->allTable();
        $this->viewApp->requestView('promotion.list.index', ['data' => $data]);
    }
    public function promotion_add(){
        $this->viewApp->requestView('promotion.add.index');
    }
    public function promotion_delete(){
        $id = $_GET['id'];
        $this->promotionModel->removeIdTable($id);
        $this->route->redirectAdmin('promotion-list');
    }
    public function promotion_post_add(){
        $data = $this->route->form;
        $this->promotionModel->insertTable($data);
        $this->route->redirectAdmin('promotion-list');
    }

    public function promotion_edit(){
        $id = $_GET['id'];
        $data = $this->promotionModel->findIdTable($id);
        $this->viewApp->requestView('promotion.edit.index', ['data' => $data]);

    } 
    public function promotion_post_edit(){
        $id = $_GET['id'];
        $data = $this->route->form;
        $this->promotionModel->updateIdTable($data, $id);
        $this->route->redirectAdmin('promotion-list');

    }
}