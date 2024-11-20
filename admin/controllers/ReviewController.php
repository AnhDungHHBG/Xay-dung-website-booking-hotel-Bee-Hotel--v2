<?php 

class ReviewController extends BaseController
{
    public $reviewModel;
    public function loadModels() {
        $this->reviewModel = new Review();
    }

    public function review_list() {
        $data = $this->reviewModel->getReviews();
        $this->viewApp->requestView('review.list.index', ['data' => $data]);
    }

    public function review_delete(){
        $id = $_GET['id'];
        $this->reviewModel->removeIdTable($id);
        $this->route->redirectAdmin('review-list');
    }
  
}