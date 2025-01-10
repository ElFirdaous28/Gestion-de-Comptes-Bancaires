<?php
require_once (__DIR__.'/../config/database.php');
require_once(__DIR__ . '/../models/Transaction.php');

class Virement extends Transaction{
    public function __construct()
    {
        parent::__construct();
    }

    public function addTransaction($transactionInfo){
        try{
            $addDepotStatment = $this->conn->prepare("INSERT INTO transactions (account_id,amount,transaction_type,beneficiary_account_id)
                                                      VALUES (?,?,?,?)");
            $addDepotStatment->execute([
                $transactionInfo["account_id"],
                $transactionInfo["amount"],
                "virement",
                $transactionInfo["beneficiary_account_id"]]);
        }
        catch(PDOException $e){
            error_log("Error adding a depot ".$e->getMessage());
        }
    }
}
?>