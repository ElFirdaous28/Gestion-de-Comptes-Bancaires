<?php
require_once(__DIR__ . '/../models/User.php');
class AuthController extends BaseController
{

    private $UserModel;
    public function __construct()
    {

        $this->UserModel = new User();
    }

    public function showLogin()
    {

        $this->render('auth/login');
    }

    //handl login function
    public function handleLogin()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['login'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userData = [$email, $password];
                $user = $this->UserModel->login($userData);

                $role = $user['role'];
                $_SESSION['user_loged_in_id'] = $user["user_id"];
                $_SESSION['user_loged_in_role'] = $role;
                $_SESSION['user_loged_in_nome'] = $user['full_name'];
                $_SESSION['user_loged_in_email'] = $user["email"];

                if ($user && $role == "admin") {
                    $this->render('admin/dashboard');
                } else if ($user && $role == "client") {
                    $this->render('client/dashboard');
                }
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_loged_in_id']) && isset($_SESSION['user_loged_in_role'])) {
            unset($_SESSION['user_loged_in_id']);
            unset($_SESSION['user_loged_in_role']);
            session_destroy();

            // header("Location: /login");
            $this->render('auth/login');
            exit;
        }
    }
}
