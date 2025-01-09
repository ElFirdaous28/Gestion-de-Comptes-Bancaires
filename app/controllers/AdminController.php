<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Account.php');
class AdminController extends BaseController
{

    private $UserModel;
    private $AccountModel;
    public function __construct()
    {

        $this->UserModel = new User();
        $this->AccountModel = new Account();
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
            $role = $_POST['client_role'];
            $password = $this->generatePassword(10);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $user = $this->UserModel->addUser($fullname, $email, $hashed_password,$role);
            header('Location: /admin/clients');
        }
    }

    // clients page
    public function clientsPage()
    {
        $users = $this->UserModel->showUsers();
        $this->render('admin/clients',["users"=>$users]);
    }

    public function updateUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user_btn'])){
            $user_id = $_POST["user_id"];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $role = $_POST['client_role'];

            $this->UserModel->updateUser($fullname,$email,$role,$user_id);
            header('location: /admin/clients');
        }
    }

    public function deleteUser(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])){
            $user_id = $_POST["user_id"];

            $this->UserModel->deleteUser($user_id);
            header('location: /admin/clients');
        }
    }

    // comptes page
    public function comptesPage()
    {
        $users = $this->UserModel->showUsers();
        $accounts = $this->AccountModel->getAccounts();
        $this->render('admin/comptes',["users"=>$users,"accounts"=>$accounts]);
    }

    public function addAcount(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_acount'])){
            $account_id = uniqid();
            $user_id = $_POST['user_id'];
            $account_type = $_POST['type_compte'];
            $balance = $_POST['balance_input'];
            $plafond_retrait_jour = $_POST['plafond_input'];
            $decouvert_autorise = $_POST['decouvert_input'];
            // var_dump($_POST); die();

            $this->AccountModel->addAcount($account_id, $user_id, $account_type, $balance,$plafond_retrait_jour,$decouvert_autorise);
            header('Location: /admin/comptes');
        }
    }

    public function deleteAccount(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])){
            $account_id = $_POST['account_id'];

            $this->AccountModel->deleteAccount($account_id);
            header('location: /admin/comptes');
        }
    }

    public function changeAccountStatus(){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])){
            $account_id = $_POST['account_id'];
            $account_status = "blocked";

            $this->AccountModel->changeAccountStatus($account_status,$account_id);
            
    
        }
        header('Location : /admin/comptes');
    }

    // transactions page
    public function transactionsPage()
    {

        $this->render('admin/transactions');
    }
}
