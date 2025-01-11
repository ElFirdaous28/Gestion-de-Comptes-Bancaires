<?php
require_once(__DIR__ . '/../includes/autoloading.php');
require_once __DIR__ . '/../../vendor/autoload.php';

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
    private $UserModel;
    public function __construct()
    {

        $this->AccountModel = new Account();
        $this->DepotModel = new Depot();
        $this->RetraitModel = new Retrait();
        $this->VirmentModel = new Virement();
        $this->BeneficiaryModel = new Beneficiary();
        $this->UserModel = new User();
    }
    // client dashboard
    public function clientDashboard()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $this->render('client/dashboard', ["accounts" => $accounts]);
    }

    // mes comptes page
    public function mesComptes()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $this->render('client/comptes', ["accounts" => $accounts]);
    }

    // methode pour cree un depot 
    public function fairDepot()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["fairDepot"])) {
            $account_id = $_POST["account_id"];
            $amount = $_POST["amount"];
            $motif = $_POST["motif"];

            if ($this->AccountModel->getStatus($account_id) !== "active")
                $_SESSION['transactionError'] = "This account is blocked. You can not make this transaction!";
            else {
                $transactionInfo = ["account_id" => $account_id, "amount" => $amount, "motif" => $motif];
                $this->DepotModel->addTransaction($transactionInfo);
                $this->AccountModel->addBalance($account_id, $amount);
            }
            header("Location: /client/comptes");
        }
    }
    // methode pour cree un depot 
    public function fairRetrait()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["fairRetrait"])) {
            $account_id = $_POST["account_id"];
            $amount = $_POST["amount"];
            $motif = $_POST["motif"];
            $transactionInfo = ["account_id" => $account_id, "amount" => $amount, "motif" => $motif];
            if ($this->AccountModel->getBalance($account_id) >= $amount) {
                $this->RetraitModel->addTransaction($transactionInfo);
                $this->AccountModel->reduceBalance($account_id, $amount);
            } else {
                $_SESSION['transactionError'] = "No enough balance!";
            }
            header("Location: /client/comptes");
        }
    }

    // virment page
    public function virement()
    {
        $accounts = $this->AccountModel->clientAccounts($_SESSION['user_loged_in_id']);
        $beneficiaries = $this->BeneficiaryModel->getClientBeneficiaries($_SESSION["user_loged_in_id"]);
        $this->render('client/virement', ["accounts" => $accounts, "beneficiaries" => $beneficiaries]);
    }

    // methode pour cree un virmentt 
    public function fairVirment()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["fairVirment"])) {
            $account_id = $_POST["account_id"];
            $amount = $_POST["amount"];
            $beneficiary_account_id = $_POST["beneficiary_account_id"];
            $motif = $_POST["motif"];

            if ($this->AccountModel->getBalance($account_id) >= $amount && $this->AccountModel->getStatus($account_id) === "active") {
                $transactionInfo = ["account_id" => $account_id, "amount" => $amount, "beneficiary_account_id" => $beneficiary_account_id, "motif" => $motif];
                $this->VirmentModel->addTransaction($transactionInfo);
                // add balance to benefu=iciary
                $this->AccountModel->addBalance($beneficiary_account_id, $amount);
                // reduce balance for current user
                $this->AccountModel->reduceBalance($account_id, $amount);
            } else if ($this->AccountModel->getBalance($account_id) < $amount)
                $_SESSION['transactionError'] = "No enough balance!";
            else if ($this->AccountModel->getStatus($account_id) !== "active")
                $_SESSION['transactionError'] = "This account is blocked. You can not make this transaction!";


            header("Location: /client/virement");
        }
    }


    // benificier page
    public function benificiers()
    {
        $beneficiaries = $this->BeneficiaryModel->getClientBeneficiaries($_SESSION["user_loged_in_id"]);
        $this->render('client/benificiers', ["beneficiaries" => $beneficiaries]);
    }

    // add beneficiary
    public function addBeneficiary()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addBeneficiary"])) {
            $beneficiary_name = $_POST["beneficiary_name"];
            $beneficiary_account_id = $_POST["beneficiary_account_id"];

            if ($this->AccountModel->accountExists($beneficiary_account_id)) {
                $this->BeneficiaryModel->addBeneficiary($_SESSION["user_loged_in_id"], $beneficiary_name, $beneficiary_account_id);
            }
            header("Location: /client/benificiers");
            exit;
        }
    }

    // add beneficiary
    public function updateBeneficiary()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["editeBeneficiary"])) {
            $beneficiary_name = $_POST["beneficiary_name"];
            $beneficiary_id = $_POST["beneficiary_id"];

            $this->BeneficiaryModel->updateBeneficiary($beneficiary_name, $beneficiary_id);
            header("Location: /client/benificiers");
            exit;
        }
    }

    // delete beneficiary
    public function deleteBeneficiary()
    {

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_beneficiary"])) {
            $beneficiary_id = $_POST["beneficiary_id"];
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
    public function transactionsList()
    {
        // get the data from $_GET
        $accountType = $_GET["accountType"];
        $transactionType = $_GET["transactionType"];
        $motif = $_GET["motif"];
        $amountMax = $_GET["amountMax"];
        $amountMin = $_GET["amountMin"];
        $user_id = $_SESSION["user_loged_in_id"];

        $transactions = $this->DepotModel->getClientTransactions($user_id, $accountType, $transactionType, $motif, $amountMin, $amountMax);
        $transactionsList = $this->renderTransactions($transactions);
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
        $user = $this->UserModel->getUserById($_SESSION['user_loged_in_id']);
        $this->render('client/profil', ["user" => $user]);
    }

    // releve du compte
    public function releveDuCompte($account_id)
    {
        // Retrieve account data using the account ID
        $account = $this->AccountModel->getAccount($account_id);
        $transactions = $this->DepotModel->getAccountTransactions($_SESSION["user_loged_in_id"], $account_id);

        // Check if account exists
        if ($account) {
            // Start output buffering to prevent any prior output
            ob_start();

            // Create new PDF document
            $pdf = new TCPDF();

            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Bank Name');
            $pdf->SetTitle('Relevé du Compte');

            // Set font
            $pdf->SetFont('helvetica', '', 12);

            // Add a page
            $pdf->AddPage();

            // Build the HTML content as a string
            $html = '<div style="max-width: 800px; margin: auto; padding: 20px;">';
            $html .= '<h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">Relevé du Compte</h1>';

            // Add account info to the page
            $html .= '<div style="margin-bottom: 20px;">';
            $html .= '<p><strong>Full Name:</strong> ' . htmlspecialchars($account['full_name']) . '</p>';
            $html .= '<p><strong>Account Type:</strong> ' . htmlspecialchars($account['account_type']) . '</p>';
            $html .= '<p><strong>Balance:</strong> ' . htmlspecialchars($account['balance']) . '</p>';
            $html .= '</div>';

            // Add table for transactions
            $html .= '<h2 style="font-size: 20px; font-weight: bold; margin-top: 20px;">Transactions</h2>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th style="text-align: left;">Date</th>';
            $html .= '<th style="text-align: left;">Motif</th>';
            $html .= '<th style="text-align: left;">Type</th>';
            $html .= '<th style="text-align: left;">Compte</th>';
            $html .= '<th style="text-align: left;">Montant</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            // Loop through transactions and add rows to the table
            foreach ($transactions as $transaction) {
                $html .= '<tr>';
                $html .= '<td>' . htmlspecialchars($transaction['created_at']) . '</td>';
                $html .= '<td>' . htmlspecialchars($transaction['motif']) . '</td>';
                $html .= '<td>' . htmlspecialchars($transaction['transaction_type']) . '</td>';
                $html .= '<td>' . htmlspecialchars($transaction['account_id']) . '</td>';
                $html .= '<td>' . htmlspecialchars($transaction['amount']) . '</td>';
                $html .= '</tr>';
            }

            $html .= '</tbody>';
            $html .= '</table>';

            // Close the container
            $html .= '</div>';

            // Write the HTML content to the PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Output the PDF in the browser (inline)
            $pdf->Output('releve_du_compte.pdf', 'I');
        } else {
            // Handle error if account is not found
            echo 'Account not found.';
        }
    }

    public function updateUserInfo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_information'])) {
            $user_id = $_SESSION["user_loged_in_id"];
            $fullname = $_POST['full_name_input'];
            $email = $_POST['email_input'];
            $this->UserModel->updateUserInformations($fullname, $email, $user_id);

            header('Location:/admin/profil');
        }
    }

    public function deleteAccountUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account_user'])) {
            $user_id = $_SESSION["user_loged_in_id"];
            echo "<script>alert('test pass');</script>";

            $this->UserModel->deleteAccountUser($user_id);
            header('Location:/login');
        }
    }
}
