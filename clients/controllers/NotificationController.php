<?php 

class NotificationController extends BaseController {
    public $clientNotificationModel;

    public function loadModels() {
        $this->clientNotificationModel = new Notification();
    }

    public function list($userId) {
        $notifications = $this->clientNotificationModel->getAllNotifications($userId);
        $this->viewApp->requestView('client.notification.list', ['notifications' => $notifications]);
    }
   
}
?>