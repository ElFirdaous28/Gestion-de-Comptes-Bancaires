<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../models/Account.php');
class ClientController extends BaseController
{

    private $AccountModel;
    public function __construct()
    {

        $this->AccountModel = new Account();
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

        $this->render('client/comptes');
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
