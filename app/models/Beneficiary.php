<?php
require_once (__DIR__.'/../config/database.php');
class Beneficiary extends DataBase{
    public function __construct()
    {
        parent::__construct();
    }

    // methode to get all Beneficiaries
    public function getClientBeneficiaries($user_id){
        try {
            $stmt = $this->conn->prepare("SELECT b.*,a.account_type FROM beneficiaries b
                                          JOIN accounts a ON b.beneficiary_account_id=a.account_id
                                          WHERE b.user_id=?");
            $stmt->execute([$user_id]);

            $beneficiaries = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $beneficiaries;
        } catch (PDOException $e) {
            error_log("Error fetching beneficiaries: " . $e->getMessage());
        }
    }

    // methode to add Beneficiary
    public function addBeneficiary($user_id, $beneficiary_name, $beneficiary_account_id)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO beneficiaries (user_id, beneficiary_account_id, beneficiary_name) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $beneficiary_account_id,$beneficiary_name]);
        } catch (PDOException $e) {
            error_log("Error adding a beneficiary: " . $e->getMessage());
            throw new Exception("Error adding a beneficiary: " . $e->getMessage());
        }
    }    

    // methode to update Beneficiary
    public function updateBeneficiary($beneficiary_name,$beneficiary_id){
        try {
            $stmt = $this->conn->prepare("UPDATE beneficiaries SET beneficiary_name=? WHERE beneficiary_id=?");
            $stmt->execute([$beneficiary_name,$beneficiary_id]);
        } catch (PDOException $e) {
            error_log("Error updating a beneficiary: " . $e->getMessage());
        }
    }

    // methode to delete Beneficiary
    public function deleteBeneficiary($beneficiary_id){
        try {
            $stmt = $this->conn->prepare("DELETE FROM beneficiaries WHERE beneficiary_id=?");
            $stmt->execute([$beneficiary_id]);

        } catch (PDOException $e) {
            error_log("Error fetching beneficiaries: " . $e->getMessage());
        }
    }

}
?>