<?php 
class AuthController extends BaseController
{
    public function loadModels() {
    }

    public function index() {
        $this->viewApp->requestView('login.login');
    }

    public function login_post() {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        if (!$email || !$password) {
            return ['error' => 'Email and password are required'];
        }

        try {
            if ($this->auth->login($email, $password)) {
            $this->route->redirectClient('/');
            } else {
                return ['error' => 'Invalid email or password'];
            }
        } catch (Exception $e) {
            return ['error' => 'An error occurred: ' . $e->getMessage()];
        }
    }
    public function logout(){
        $this->auth->logout();
        $this->route->redirectClient('/');
    }

    public function admin_page(){
        $this->viewApp->requestView('admin.views.layout.index');
    }
}
