<?php
require_once(__DIR__ . '/../config/database.php');
abstract class Transaction extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getClientTransactions($user_id, $accountType, $transactionType, $motif, $amountMin, $amountMax)
    {
        try {
            $query = "SELECT t.*,a.account_type,b.beneficiary_name FROM transactions t
                     JOIN accounts a ON a.account_id=t.account_id
                     LEFT JOIN beneficiaries b ON b.beneficiary_account_id=t.beneficiary_account_id
                     WHERE a.user_id=? ";
            $params = [$user_id];
            // filter by account type query
            if (!empty($accountType)) {
                $query .= "AND a.account_type=?";
                $params[] = $accountType;
            }

            // filter by operation Type query
            if (!empty($transactionType)) {
                $query .= "AND t.transaction_type=?";
                $params[] = $transactionType;
            }

            // search by motif
            if (!empty($motif)) {
                $query .= "AND t.motif LIKE ?";
                $params[] = "%$motif%";
            }

            // min amount
            if (!empty($amountMin)) {
                $query .= "AND t.amount>= ?";
                $params[] = $amountMin;
            }

            // max amount
            if (!empty($amountMax)) {
                $query .= "AND t.amount<= ?";
                $params[] = $amountMax;
            }

            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $transactions;
        } catch (PDOException $e) {
            error_log("error getting transactions " . $e);
        }
    }

    // methode to get account transactions 
    public function getAccountTransactions($user_id, $account_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT t.*,a.account_type,b.beneficiary_name FROM transactions t
                                          JOIN accounts a ON a.account_id=t.account_id
                                          LEFT JOIN beneficiaries b ON b.beneficiary_account_id=t.beneficiary_account_id
                                          WHERE a.user_id=? ");
            $stmt->execute([$user_id]);
            $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $transactions;
        } catch (PDOException $e) {
            error_log("error getting transactions " . $e);
        }
    }

    abstract public function addTransaction($transactionInfo);
}
