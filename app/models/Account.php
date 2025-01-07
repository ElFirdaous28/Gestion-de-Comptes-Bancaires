<?php
require_once(__DIR__ . '/../config/database.php');
class Account extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    // method to get client accounts
    public function clientAccounts($user_is)
    {
        try {
            $accountsStatement = $this->conn->prepare("SELECT * FROM accounts WHERE user_id = ?");
            $accountsStatement->execute([$user_is]);

            $accounts = $accountsStatement->fetchAll(PDO::FETCH_ASSOC);
            return $accounts;
        } catch (PDOException $e) {
            echo "Error finding user accounts: " . $e->getMessage();
        }
    }
}
