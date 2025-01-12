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
                if ($user == false) {

                    $_SESSION["login_error"] = "Email not found or incorrect password!";
                    $_SESSION["old_email"] = $_POST['email']; // Save email input

                    // Redirect back to the login form
                    header('Location: /login');
                    exit;
                } else {
                    $role = $user['role'];
                    $_SESSION['user_loged_in_id'] = $user["user_id"];
                    $_SESSION['user_loged_in_role'] = $role;
                    $_SESSION['user_loged_in_name'] = $user['full_name'];
                    $_SESSION['user_loged_in_email'] = $user['email'];

                    if ($user && $role == "admin") {
                        header('Location: /admin/dashboard');
                    } else if ($user && $role == "client") {
                        header('Location: /client/dashboard');
                    }
                    exit;
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
            header("Location:/login");
            exit;
        }
    }
}
