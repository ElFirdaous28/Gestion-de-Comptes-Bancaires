<?php
require_once(__DIR__ . '/../config/database.php');
class Account extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addAcount($account_id, $user_id, $account_type, $balance, $plafond_retrait_jour, $decouvert_autorise)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO accounts (account_id, user_id, account_type, balance,plafond_retrait_jour,decouvert_autorise) VALUES(?,?,?,?,?,?)");
            $stmt->execute([$account_id, $user_id, $account_type, $balance, $plafond_retrait_jour, $decouvert_autorise]);
        } catch (PDOException $e) {
            echo "Error in add acount: " . $e->getMessage();
        }
    }

    public function getAccounts()
    {
        try {
            $getAccountQuery = $this->conn->prepare("SELECT accounts.*, users.full_name ,users.email FROM accounts
                            LEFT JOIN users ON accounts.user_id = users.user_id;");
            $getAccountQuery->execute();

            $accounts = $getAccountQuery->fetchAll(PDO::FETCH_ASSOC);
            return $accounts;
        } catch (PDOException $e) {
            echo "Error in getAccounts: " . $e->getMessage();
        }
    }

    public function deleteAccount($account_id)
    {
        try {
            $deleteAccountQuery = $this->conn->prepare("DELETE FROM accounts WHERE account_id = ?");
            $deleteAccountQuery->execute([$account_id]);
        } catch (PDOException $e) {
            echo "Error in deleteAcount: " . $e->getMessage();
        }
    }

    public function getAccountStatus($account_id)
    {
        $stmt = $this->conn->prepare("SELECT account_status FROM accounts WHERE account_id = ?");
        $stmt->execute([$account_id]);
        return $stmt->fetchColumn();
    }

    public function changeAccountStatus($account_status, $account_id)
    {
        try {
            $changeStatusQuery = $this->conn->prepare("UPDATE accounts SET account_status= ? WHERE account_id = ?");
            $changeStatusQuery->execute([$account_status, $account_id]);
        } catch (PDOException $e) {
            echo "Error in changeAccountStatus: " . $e->getMessage();
        }
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
}
