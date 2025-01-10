<?php
require_once(__DIR__ .'/../includes/autoloading.php');
// require_once(__DIR__ . '/../models/User.php');
// require_once(__DIR__ . '/../models/Account.php');
// require_once(__DIR__ . '/../models/Depot.php');
// require_once(__DIR__ . '/../models/Retrait.php');
// require_once(__DIR__ . '/../models/Beneficiary.php');
// require_once(__DIR__ . '/../models/Virement.php');
class ClientController extends BaseController
{

    private $AccountModel;
    private $DepotModel;
    private $RetraitModel;
    private $VirmentModel;
    private $BeneficiaryModel;
    public function __construct()
    {

        $this->AccountModel = new Account();
        $this->DepotModel = new Depot();
        $this->RetraitModel = new Retrait();
        $this->VirmentModel = new Virement();
        $this->BeneficiaryModel = new Beneficiary();
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
            $this->RetraitModel->addTransaction($transactionInfo);
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
    // methode to show transactions
    public function transactionsList(){
        // get the data from $_GET
        $accountType = $_GET["accountType"];
        $transactionType = $_GET["transactionType"];
        $motif = $_GET["motif"];
        $amountMax = $_GET["amountMax"];
        $amountMin = $_GET["amountMin"];

        $transactions =$this->DepotModel->getTransactions($accountType, $transactionType, $motif, $amountMin,$amountMax);
        $transactionsList=$this->renderTransactions($transactions);
        echo $transactionsList;
    }
    // methode that reneders the trsactions
    public function renderTransactions($transactions)
    {
        $html = ''; // Initialize an empty string to hold the HTML content

        if ($transactions) {
            foreach ($transactions as $transaction) {
                $typeClass = $transaction["transaction_type"] === 'depot' ? 'bg-green-100 text-green-800' 
                            : ($transaction["transaction_type"] === 'retrait' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800');
                $amountClass = $transaction["transaction_type"] === 'depot' ? 'text-green-600' : 'text-red-600';

                $html .= '<tr class="hover:bg-gray-50">';
                
                // Date and time
                $html .= '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-col gap-2">
                            <div>' . htmlspecialchars(date("Y-m-d", strtotime($transaction["created_at"]))) . '</div>
                            <div>' . htmlspecialchars(date("H:i:s", strtotime($transaction["created_at"]))) . '</div>
                        </td>';
                
                // Motif
                $html .= '<td class="px-6 py-4 text-sm text-gray-900 max-w-40">' . htmlspecialchars($transaction["motif"]) . '</td>';
                
                // Transaction type with dynamic styling
                $html .= '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize min-w-16 ' . $typeClass . '">
                                ' . htmlspecialchars($transaction["transaction_type"]) . '
                            </span>
                        </td>';
                
                // Account type
                $html .= '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 capitalize">
                            Compte ' . htmlspecialchars($transaction["account_type"]) . '
                        </td>';
                
                // Amount with dynamic text color
                $html .= '<td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium ' . $amountClass . '">
                            ' . ($transaction["transaction_type"] === 'depot' ? '+' : '-') . ' ' . htmlspecialchars($transaction["amount"]) . '€
                        </td>';
                
                // Details button
                $html .= '<td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button class="text-blue-600 hover:text-blue-900">Détails</button>
                        </td>';
                
                $html .= '</tr>';
            }
        } else {
            $html .= "<tr><td colspan='6' class='text-center py-4 text-gray-500'>No transactions found.</td></tr>";
        }

        return $html; // Return the generated HTML
    }
    
    // profil page
    public function profil()
    {

        $this->render('client/profil');
    }
}
