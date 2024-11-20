<?php 

class NotificationController extends BaseController {
    public $notificationModel;

    public function loadModels() {
        $this->notificationModel = new Notification();
    }

    public function list() {
        $notifications = $this->notificationModel->getAllNotifications();
        $this->viewApp->requestView('notification.list.index', ['data' => $notifications]);
    }

    public function create($title, $content) {
        $this->notificationModel->createNotification($title, $content);
    }
}
?>