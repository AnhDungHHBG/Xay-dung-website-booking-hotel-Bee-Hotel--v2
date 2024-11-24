<?php

abstract class BaseController {
    public $route;
    public $viewApp;
    public $auth;

    public function __construct() {
        global $route;
        global $viewApp;
        global $auth;
        $this->route = $route;
        $this->viewApp = $viewApp;
        $this->auth = $auth;
        $this->loadModels();
    }

    public function checkAccess() {
        if (!$this->auth->isLogin) {
            header("Location: /login.php");
            exit();
        }
    }
    public function upload_images($files) {
        $uploaded_files = [];
        $errors = [];
    
        foreach ($files['name'] as $key => $file_name) {
            $tmp_name = $files['tmp_name'][$key];
            $file_size = $files['size'][$key];
            $file_error = $files['error'][$key];
    
            if ($file_error === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/room_images/';
                $upload_file = $upload_dir . basename($file_name);
    
                if (move_uploaded_file($tmp_name, $upload_file)) {
                    $uploaded_files[] = ['image_url' => $upload_file]; 
                } else {
                    $errors[] = "Lỗi khi tải ảnh $file_name lên.";
                }
            } else {
                $errors[] = "Có lỗi xảy ra khi tải ảnh $file_name lên.";
            }
        }
    
        return [
            'uploaded_files' => $uploaded_files,
            'errors' => $errors
        ];
    }
    
    

    abstract public function loadModels();
}
