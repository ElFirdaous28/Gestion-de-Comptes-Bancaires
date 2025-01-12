<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Account.php');

require_once __DIR__ . '/../../vendor/autoload.php';


// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);
        $this->render('admin/dashboard', ["user" => $user]);
    }

    public function generatePassword($length)
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $role = $_POST['client_role'];
            $password = $this->generatePassword(10);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $this->UserModel->addUser($fullname, $email, $hashed_password, $role);
            $this->sendLatePasswordEmail($email,$fullname,$password);            
            header('Location: /admin/clients');
        }
    }

    // clients page
    public function clientsPage()
    {
        $users = $this->UserModel->showUsers();
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);

        $this->render('admin/clients', ["users" => $users, "user" => $user]);
    }

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user_btn'])) {
            $user_id = $_POST["user_id"];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $role = $_POST['client_role'];

            $this->UserModel->updateUser($fullname, $email, $role, $user_id);

            header('location:/admin/clients');
        }
    }

    public function deleteUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
            $user_id = $_POST["user_id"];

            $this->UserModel->deleteUser($user_id);
            header('location:/admin/clients');
        }
    }

    // comptes page
    public function comptesPage()
    {
        $users = $this->UserModel->showUsers();
        $accounts = $this->AccountModel->getAccounts();
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);
        $this->render('admin/comptes', ["users" => $users, "accounts" => $accounts, "user" => $user]);
    }

    public function addAcount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_acount'])) {
            $account_id = uniqid();
            $user_id = $_POST['user_id'];
            $account_type = $_POST['type_compte'];
            $balance = $_POST['balance_input'];
            $plafond_retrait_jour = $_POST['plafond_input'];
            $decouvert_autorise = $_POST['decouvert_input'];
            // var_dump($_POST); die();

            $this->AccountModel->addAcount($account_id, $user_id, $account_type, $balance, $plafond_retrait_jour, $decouvert_autorise);
            header('Location:/admin/comptes');
        }
    }

    public function deleteAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
            $account_id = $_POST['account_id'];

            $this->AccountModel->deleteAccount($account_id);
            header('location:/admin/comptes');
        }
    }

    public function changeAccountStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_status'])) {
            $account_id = $_POST['account_id'];

            $current_status = $this->AccountModel->getAccountStatus($account_id);
            $new_status = ($current_status === 'active') ? 'blocked' : 'active';
            $this->AccountModel->changeAccountStatus($new_status, $account_id);

            header('Location:/admin/comptes');
        }
    }

    // transactions page
    public function transactionsPage()
    {
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);
        $this->render('admin/transactions', ["user" => $user]);
    }

    // methode to send password email
    function sendLatePasswordEmail($RecipientEmail, $RecipientName, $password)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.mailtrap.io';           // Mailtrap SMTP server
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'b1ff058a8905cc'; // Your Mailtrap SMTP username
            $mail->Password = '9a5764e0891c7b'; // Your Mailtrap SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
            $mail->Port = 2525;                         // TCP port to connect to (2525, 465, or 587)

            // Recipients
            $mail->setFrom($RecipientEmail, $RecipientName); // Sender's email
            $mail->addAddress($RecipientEmail, $RecipientName); // Recipient's email

            // Content
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->Subject = 'Bnak : login informations';  // Subject line
            $mail->Body = "<p>Dear $RecipientName,</p>
                            <p>Your account has been created. Here are your login details:</p>
                            <ul>
                                <li><strong>Email:</strong> $RecipientEmail</li>
                                <li><strong>Password:</strong> $password</li>
                            </ul>
                            <p>You can log in here: <a href='#'>login</a></p>
                            <p>If you have any issues, feel free to contact us.</p>
                            <p>Best regards,<br>Your Support Team</p>";


            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
