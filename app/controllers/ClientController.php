<?php
require_once(__DIR__ . '/../models/User.php');
class ClientController extends BaseController
{

    private $UserModel;
    public function __construct()
    {

        // $this->UserModel = new User();
    }
    // client dashboard
    public function clientDashboard()
    {

        $this->render('client/dashboard');
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
