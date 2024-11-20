<?php 
class LoginController extends BaseController
{
    public $userModel;

    public function loadModels() {
        $this->userModel = new User();
    }

    public function index() {
        $this->viewApp->requestView('login.login');
    }

    public function login_post() {
        $data = $this->route->form;

        $email = $data['email'] ?? null;
        echo $email;
        die();
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return ['error' => 'Email and password are required'];
        }

        try {
            $user = (array)$this->userModel->findUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                return ['success' => true, 'user' => $user];
            } else {
                return ['error' => 'Invalid email or password'];
            }
        } catch (Exception $e) {
            return ['error' => 'An error occurred'];
        }
        $this->route->redirectClient('/');
    }
}
