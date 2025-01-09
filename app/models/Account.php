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
}


?>