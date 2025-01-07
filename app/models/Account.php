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


    // methode to get amount 
    public function getAmount($account_id)
    {
        try {
            $getAmountStatement = $this->conn->prepare("SELECT balance FROM accounts WHERE account_id = ?");
            $getAmountStatement->execute([$account_id]);

            $amount = $getAmountStatement->fetchColumn();;
            return $amount;
        } catch (PDOException $e) {
            echo "Error finding user accounts: " . $e->getMessage();
        }
    }

    // methode to update the amount
    public function addAmount($account_id,$transaction_amount)
    {
        echo "add amount called";
        $oldAmount= $this->getAmount($account_id);
        $newAmount=(int)$oldAmount+(int)$transaction_amount;

        try {
            $updateAmountStatement = $this->conn->prepare("UPDATE accounts SET balance=? WHERE account_id=?");
            $updateAmountStatement->execute([$newAmount,$account_id]);
        } catch (PDOException $e) {
            echo "Error updating the amount: " . $e->getMessage();
        }
    }
}
