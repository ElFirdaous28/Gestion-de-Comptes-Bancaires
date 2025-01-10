<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Account.php');
require_once(__DIR__ . '/../models/Depot.php');
require_once(__DIR__ . '/../models/Beneficiary.php');
require_once(__DIR__ . '/../models/Virement.php');
class ClientController extends BaseController
{

    private $AccountModel;
    private $DepotModel;
    private $VirmentModel;
    private $BeneficiaryModel;
    private $UserModel;
    public function __construct()
    {

        $this->AccountModel = new Account();
        $this->DepotModel = new Depot();
        $this->VirmentModel = new Virement();
        $this->BeneficiaryModel = new Beneficiary();
        $this->UserModel = new User();
    }
    // client dashboard
    public function clientDashboard()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $this->render('client/dashboard',["accounts"=>$accounts]);
    }

    // mes comptes page
    public function mesComptes()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $this->render('client/comptes',["accounts"=>$accounts]);
    }

    // methode pour cree un depot 
    public function fairDepot(){
        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["fairDepot"])){
            $account_id = $_POST["account_id"];
            $amount= $_POST["amount"];
            $transactionInfo=["account_id"=>$account_id,"amount"=>$amount];
            $this->DepotModel->addTransaction($transactionInfo);
            $this->AccountModel->addBalance($account_id,$amount);
            header("Location: /client/comptes");
        }
    }
    // methode pour cree un depot 
    public function fairRetrait(){
        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["fairRetrait"])){
            $account_id = $_POST["account_id"];
            $amount= $_POST["amount"];
            $transactionInfo=["account_id"=>$account_id,"amount"=>$amount];
            $this->DepotModel->addTransaction($transactionInfo);
            $this->AccountModel->reduceBalance($account_id,$amount);
            header("Location: /client/comptes");
        }
    }

    // virment page
    public function virement()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $beneficiaries = $this->BeneficiaryModel->getClientBeneficiaries($_SESSION["user_loged_in_id"]);
        $this->render('client/virement',["accounts"=>$accounts,"beneficiaries"=>$beneficiaries]);
    }

     // methode pour cree un virmentt 
     public function fairVirment(){
        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["fairVirment"])){
            $account_id = $_POST["account_id"];
            $amount= $_POST["amount"];
            $beneficiary_account_id= $_POST["beneficiary_account_id"];

            $transactionInfo=["account_id"=>$account_id,"amount"=>$amount,"beneficiary_account_id"=>$beneficiary_account_id];
            $this->VirmentModel->addTransaction($transactionInfo);
            // add balance to benefu=iciary
            $this->AccountModel->addBalance($beneficiary_account_id,$amount);
            // reduce balance for current user
            $this->AccountModel->reduceBalance($account_id,$amount);

            header("Location: /client/virement");
        }
    }

    // benificier page
    public function benificiers()
    {
        $beneficiaries = $this->BeneficiaryModel->getClientBeneficiaries($_SESSION["user_loged_in_id"]);
        $this->render('client/benificiers',["beneficiaries"=>$beneficiaries]);
    }

    // add beneficiary
    public function addBeneficiary(){

        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["addBeneficiary"])){
            $beneficiary_name=$_POST["beneficiary_name"];
            $beneficiary_account_id = $_POST["beneficiary_account_id"];

            if ($this->AccountModel->accountExists($beneficiary_account_id)) {
                $this->BeneficiaryModel->addBeneficiary($_SESSION["user_loged_in_id"], $beneficiary_name, $beneficiary_account_id);
            }
            header("Location: /client/benificiers");
            exit;      
        }
    }

    // add beneficiary
    public function updateBeneficiary(){

        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["editeBeneficiary"])){
            $beneficiary_name=$_POST["beneficiary_name"];
            $beneficiary_id = $_POST["beneficiary_id"];

            $this->BeneficiaryModel->updateBeneficiary($beneficiary_name,$beneficiary_id);
            header("Location: /client/benificiers");
            exit;      
        }
    }

    // delete beneficiary
    public function deleteBeneficiary(){

        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["delete_beneficiary"])){
            $beneficiary_id= $_POST["beneficiary_id"];
            $this->BeneficiaryModel->deleteBeneficiary($beneficiary_id);
            header("Location: /client/benificiers");
            exit;      
        }
    }

    // historique page
    public function historique()
    {

        $this->render('client/historique');
    }

    // profil page
    public function profil()
    {
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);
        $this->render('client/profil',["user"=>$user]);
    }

   public function updateUserInfo(){
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_information'])){
        $user_id = $_SESSION["user_loged_in_id"];
        $fullname = $_POST['full_name_input'];
        $email = $_POST['email_input'];
        $this->UserModel->updateUserInformations($fullname, $email, $user_id);

        header('Location:/admin/profil');
    }
   }
}
