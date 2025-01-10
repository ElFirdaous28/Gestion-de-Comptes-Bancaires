<?php
require_once (__DIR__.'/../config/database.php');
require_once(__DIR__ . '/../models/Transaction.php');

class Depot extends Transaction{
    public function __construct()
    {
        parent::__construct();
    }

    public function addTransaction($transactionInfo){
        try{
            $addDepotStatment = $this->conn->prepare("INSERT INTO transactions (account_id,amount,transaction_type,motif)
                                                      VALUES (?,?,?,?)");
            $addDepotStatment->execute([$transactionInfo["account_id"],$transactionInfo["amount"],"depot",$transactionInfo["motif"]]);
        }
        catch(PDOException $e){
            error_log("Error adding a depot ".$e->getMessage());
        }
    }
}
?>