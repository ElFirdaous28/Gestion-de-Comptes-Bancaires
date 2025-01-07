<?php
require_once(__DIR__ . '/../models/User.php');
class AdminController extends BaseController
{

    private $UserModel;
    public function __construct()
    {

        $this->UserModel = new User();
    }

    public function adminDashboard()
    {

        $this->render('admin/dashboard');
    }

    function generatePassword($length) {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

    public function addUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $this->generatePassword(10);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $user = $this->UserModel->addUser($fullname, $email, $hashed_password,$role);
            header('Location: /admin/clients');
        }
    }

    // clients page
    public function clientsPage()
    {

        $this->render('admin/clients');
    }

    // comptes page
    public function comptesPage()
    {

        $this->render('admin/comptes');
    }

    // transactions page
    public function transactionsPage()
    {

        $this->render('admin/transactions');
    }
}
