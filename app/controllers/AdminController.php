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

    public function generatePassword($length) {

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
            $this->render('admin/clients');
        }
    }

    // clients page
    public function clientsPage()
    {
        $users = $this->UserModel->showUsers();
        // echo '<pre>';
        // var_dump($users); die();
        // echo '</pre>';
        $this->render('admin/clients',["users"=>$users]);
    }

    public function updateUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_btn'])){
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
        }
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
