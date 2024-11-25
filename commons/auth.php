<?php
session_start();

class Auth {
    public $isLogin = false;
    public $conn;

    public function __construct() {
        global $coreApp;
        $this->conn = $coreApp->connectDB();
        $this->isLogin = $this->isLoggedIn();
    }


    public function login($email, $password) {

        if (!$this->conn) {
            error_log("Database connection failed.");
            return false;
        }
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            error_log("Failed to prepare SQL statement.");
            return false;
        }

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $createdAt =  $user['created_at'];
        $formattedDate = (new DateTime($createdAt))->format('d/m/Y H:i');

        if ($user['password'] == $password) {
            $_SESSION['user'] = [
                'name' => $user['name'],
                'user_id' => $user['id'],
                'email' => $user['email'],
                'role' => isset($user['role']) ? $user['role'] : null,
            ];
           
            $this->isLogin = true;
            return true;
        } else {
            error_log("Login failed for email: $email");
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        session_destroy(); 
        $this->isLogin = false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['user']); 
    }

    public function getUser() {
        return $_SESSION['user'] ?? null;
    }
}
?>