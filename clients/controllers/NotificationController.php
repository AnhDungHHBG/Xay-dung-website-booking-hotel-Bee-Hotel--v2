<?php 

class NotificationController extends BaseController {
    public $notificationModel;

    public function loadModels() {
        $this->notificationModel = new Notification();
    }

    public function list() {
        $userId = 1;
        $notifications = $this->notificationModel->getAllNotifications($userId);
        $this->viewApp->requestView('notification.list.index', ['notifications' => $notifications]);
    }
   
}
?>