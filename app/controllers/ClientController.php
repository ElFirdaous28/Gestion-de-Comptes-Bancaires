<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Account.php');
require_once(__DIR__ . '/../models/Depot.php');
class ClientController extends BaseController
{

    private $AccountModel;
    private $DepotModel;
    public function __construct()
    {

        $this->AccountModel = new Account();
        $this->DepotModel = new Depot();
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

        $this->render('client/virement');
    }

    // benificier page
    public function benificier()
    {

        $this->render('client/benificier');
    }

    // historique page
    public function historique()
    {

        $this->render('client/historique');
    }

    // profil page
    public function profil()
    {

        $this->render('client/profil');
    }
}
