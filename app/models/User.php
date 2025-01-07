<?php
require_once (__DIR__.'/../config/database.php');
class User extends DataBase{
    public function __construct()
    {
        parent::__construct();
    }

    public function addUser($fullname, $email,$hashed_password,$role){
        try{
            $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, password,role) VALUES(?,?,?,?)");
            $stmt->execute([$fullname, $email,$hashed_password,$role]);
        }catch (PDOException $e) {
            echo "Error in add user: " . $e->getMessage();
        }

    }

    public function login($userData){
    
        try {
            $result = $this->conn->prepare("SELECT * FROM users WHERE email=?");
            $result->execute([$userData[0]]);
            $user = $result->fetch(PDO::FETCH_ASSOC);
    
            if($user && password_verify($userData[1], $user["password"])){
               return  $user ;
            }
        } catch (PDOException $e) {
            echo "Error in login function: " . $e->getMessage();
        }
    }
}
?>