<?php
require_once (__DIR__.'/../config/database.php');
class User extends DataBase{
    public function __construct()
    {
        parent::__construct();
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

    public function addUser($fullname, $email,$hashed_password,$role){
        try{
            $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, password,role) VALUES(?,?,?,?)");
            $stmt->execute([$fullname, $email,$hashed_password,$role]);
        }catch (PDOException $e) {
            echo "Error in add user: " . $e->getMessage();
        }
    }

    public function showUsers(){
        try{
            $showUsersQuery = $this->conn->prepare("SELECT users.*,COUNT(accounts.user_id) as accounts_number, accounts.account_type 
                                            FROM users
                                            LEFT JOIN accounts ON users.user_id = accounts.user_id
                                            GROUP BY users.user_id, accounts.account_type;");
            $showUsersQuery->execute();

            $users = $showUsersQuery->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }catch (PDOException $e) {
            echo "Error in show user: " . $e->getMessage();
        }
    }

    public function updateUser($fullname,$user_id){
        try{
            $updateUserQuery = $this->conn->prepare("UPDATE users SET full_name = ?, email = ?, WHERE user_id = ?");
            $updateUserQuery->execute([$fullname,$user_id]);
        }catch(PDOException $e){
            echo "Error in update user: " . $e->getMessage();
        }
    }
} 
?>