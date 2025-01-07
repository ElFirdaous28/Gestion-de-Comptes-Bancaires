<?php
require_once(__DIR__ . '/../config/database.php');
abstract class Transaction extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    abstract public function addTransaction($transactionInfo);

    // methode to delet a transaction
    public function deleteTransaction($transactionId)
    {
        try {
            $deleteTransactionStatment = $this->conn->prepare("DELETE FROM transactions WHERE id_transaction=?");
            $deleteTransactionStatment->execute([$transactionId]);
        } catch (PDOException $e) {
            error_log("Error deleting a transaction: " . $e->getMessage());
        }
    }
}
