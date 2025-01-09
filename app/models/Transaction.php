<?php
require_once(__DIR__ . '/../config/database.php');
abstract class Transaction extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getALLTransactions()
    {
        try {
            $stmt = $this->conn->prepare("SELECT t.*,a.account_type,b.beneficiary_name FROM transactions t
                                          JOIN accounts a ON a.account_id=t.account_id
                                          LEFT JOIN beneficiaries b ON b.beneficiary_account_id=t.beneficiary_account_id");
            $stmt->execute();

            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // echo "<pre>";
            // var_dump($transactions);
            // die;
            return $transactions;
        } catch (PDOException $e) {
            error_log("error getting transactions " . $e);
        }
    }

    abstract public function addTransaction($transactionInfo);
}
