<?php

class CoreApp {
    public $connDbGlobal;

    public function __construct() {
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'env.php'));
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'route.php'));
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'model.php'));
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'controller.php'));
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'view.php'));
        require_once join(DIRECTORY_SEPARATOR, array('.', 'commons', 'auth.php'));
    
    }

    public function initApp($prefix) {
        global $route;
        $this->loadControllers($prefix);
        $this->loadModels($prefix);
        $this->loadAuth($prefix);

        require_once join(DIRECTORY_SEPARATOR, array('.', $prefix, 'router.php'));
    }

    public function loadAllFileWithStruct($directory, $struct) {
        $files = glob($directory . $struct);
        foreach ($files as $file) {
            require_once $file;
        }
    }

    public function loadControllers($directory) {
        $directory = join(DIRECTORY_SEPARATOR, array('.', $directory, 'controllers'));
        $this->loadAllFileWithStruct($directory,  '/*Controller.php');
    }

    public function loadModels($directory) {
        $directory = join(DIRECTORY_SEPARATOR, array('.', $directory, 'models'));
        $this->loadAllFileWithStruct($directory,  '/*.php');
    }
    public function loadAuth($directory) {
        $directory = join(DIRECTORY_SEPARATOR, array('.', $directory, 'auth'));
        $this->loadAllFileWithStruct($directory,  '/*.php');
    }

    public function connectDB() {
        if ($this->connDbGlobal !== null) return $this->connDbGlobal;
        $host = DB_HOST;
        $port = DB_PORT;
        $dbname = DB_NAME;

        try {
            $this->connDbGlobal = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);
            $this->connDbGlobal->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connDbGlobal->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
            return $this->connDbGlobal;
        } catch (PDOException $e) {
            $this->debug("Connection failed: " . $e->getMessage());
        }
    }

    public function debug($data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}