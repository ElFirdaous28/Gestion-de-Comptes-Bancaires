<?php 
require_once (__DIR__.'/../config/database.php');

class Account extends DataBase{
    public function __construct()
    {
        parent::__construct();
    }

public function addAcount($account_id, $user_id, $account_type, $balance,$plafond_retrait_jour,$decouvert_autorise){
    try{
        $stmt = $this->conn->prepare("INSERT INTO accounts (account_id, user_id, account_type, balance,plafond_retrait_jour,decouvert_autorise) VALUES(?,?,?,?,?,?)");
        $stmt->execute([$account_id, $user_id, $account_type, $balance,$plafond_retrait_jour,$decouvert_autorise]);
    }catch (PDOException $e) {
        echo "Error in add acount: " . $e->getMessage();
    }
}

public function getAccounts(){
    try{
        $getAccountQuery = $this->conn->prepare("SELECT accounts.*, users.full_name ,users.email FROM accounts
                            LEFT JOIN users ON accounts.user_id = users.user_id;");
        $getAccountQuery->execute();

        $accounts = $getAccountQuery->fetchAll(PDO::FETCH_ASSOC);
        return $accounts;
    }catch (PDOException $e) {
        echo "Error in getAcount: " . $e->getMessage();
    }
}
}


?>