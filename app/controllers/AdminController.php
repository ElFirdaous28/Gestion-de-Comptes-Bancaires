<?php
require_once(__DIR__ . '/../models/User.php');
class AdminController extends BaseController
{

    private $UserModel;
    public function __construct()
    {

        // $this->UserModel = new User();
    }

    public function adminDashboard()
    {

        $this->render('admin/dashboard');
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
