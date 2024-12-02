<?php 

class NotificationController extends BaseController {
    public function __construct() {
        parent::__construct(); 
        $this->isLogin();
    }
    public $notificationModel;

    public function loadModels() {
        $this->notificationModel = new Notification();
    }

    public function list() {
        $userId = $_SESSION['user']['user_id'];
        $notifications = $this->notificationModel->getAllNotifications($userId);
        $this->viewApp->requestView('notification.list.index', ['data' => $notifications]);
    }
   
}
?>