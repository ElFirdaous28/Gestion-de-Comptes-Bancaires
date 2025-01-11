<?php
require_once(__DIR__ . '/../config/database.php');
class Account extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    // method to get client accounts
    public function clientAccounts($user_id)
    {
        try {
            $accountsStatement = $this->conn->prepare("SELECT * FROM accounts WHERE user_id = ?");
            $accountsStatement->execute([$user_id]);

            $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);
            return $accounts;
        } catch (PDOException $e) {
            echo "Error finding user accounts: " . $e->getMessage();
        }
    }

    // check if account exists
    public function accountExists($account_id)
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM accounts WHERE account_id = ?");
        $stmt->execute([$account_id]);
        return $stmt->fetchColumn() > 0;
    }

    // methode to get amount 
    public function getStatus($account_id)
    {
        try {
            $getStatusStatement = $this->conn->prepare("SELECT account_status FROM accounts WHERE account_id = ?");
            $getStatusStatement->execute([$account_id]);

            $status = $getStatusStatement->fetchColumn();;
            return $status;
        } catch (PDOException $e) {
            echo "Error finding user accounts: " . $e->getMessage();
        }
    }
    
    // methode to get amount 
    public function getBalance($account_id)
    {
        try {
            $getBalanceStatement = $this->conn->prepare("SELECT balance FROM accounts WHERE account_id = ?");
            $getBalanceStatement->execute([$account_id]);

            $amount = $getBalanceStatement->fetchColumn();;
            return $amount;
        } catch (PDOException $e) {
            echo "Error finding user accounts: " . $e->getMessage();
        }
    }

    // methode to update the balance
    public function updateBalance($account_id, $newBalance)
    {
        try {
            $updateAmountStatement = $this->conn->prepare("UPDATE accounts SET balance=? WHERE account_id=?");
            $updateAmountStatement->execute([$newBalance, $account_id]);
        } catch (PDOException $e) {
            echo "Error updating the amount: " . $e->getMessage();
        }
    }
    // methode to add the amount to balance
    public function addBalance($account_id, $transaction_amount)
    {
        echo "add amount called";
        $oldAmount = $this->getBalance($account_id);
        $newBalance = (float)$oldAmount + (float)$transaction_amount;

        $this->updateBalance($account_id, $newBalance);
    }

    // methode to reduce the amount from the balance
    public function reduceBalance($account_id, $transaction_amount)
    {
        echo "add amount called";
        $oldAmount = $this->getBalance($account_id);
        $newBalance = (float)$oldAmount - (float)$transaction_amount;

        $this->updateBalance($account_id, $newBalance);
    }

    // methode to get account infos
    public function getAccount($account_id)
    {
        $stmt = $this->conn->prepare("SELECT a.*,u.full_name FROM accounts a
                                      JOIN users u ON a.user_id=u.user_id
                                      WHERE account_id = ?");
        $stmt->execute([$account_id]);
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        return $account;
    }
}
