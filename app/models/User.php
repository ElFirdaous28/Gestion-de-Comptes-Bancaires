<?php
require_once(__DIR__ . '/../config/database.php');
class User extends DataBase
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($userData)
    {

        try {
            $result = $this->conn->prepare("SELECT * FROM users WHERE email=?");
            $result->execute([$userData[0]]);
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($userData[1], $user["password"])) {
                return  $user;
            } else
                return false;
        } catch (PDOException $e) {
            echo "Error in login function: " . $e->getMessage();
        }
    }

    public function addUser($fullname, $email, $hashed_password, $role)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, password,role) VALUES(?,?,?,?)");
            $stmt->execute([$fullname, $email, $hashed_password, $role]);
        } catch (PDOException $e) {
            echo "Error in add user: " . $e->getMessage();
        }
    }

    public function showUsers()
    {
        try {
            $showUsersQuery = $this->conn->prepare("SELECT users.*, COUNT(accounts.user_id) AS accounts_number
                                                    FROM users
                                                    LEFT JOIN accounts ON users.user_id = accounts.user_id
                                                    WHERE users.role != 'admin'
                                                    GROUP BY users.user_id;");
            $showUsersQuery->execute();

            $users = $showUsersQuery->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        } catch (PDOException $e) {
            echo "Error in show user: " . $e->getMessage();
        }
    }

    public function updateUser($fullname, $email, $role, $user_id)
    {
        try {
            $updateUserQuery = $this->conn->prepare("UPDATE users SET full_name = ?, email = ?, role = ? WHERE user_id = ?");
            $updateUserQuery->execute([$fullname, $email, $role, $user_id]);
        } catch (PDOException $e) {
            echo "Error in update user: " . $e->getMessage();
        }
    }

    public function deleteUser($user_id)
    {
        try {
            $deleteUserQuery = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
            $deleteUserQuery->execute([$user_id]);
        } catch (PDOException $e) {
            echo "Error in update user: " . $e->getMessage();
        }
    }

    public function updateUserInformations($fullname, $email, $user_id)
    {
        try {
            $updateUserInfoQuery = $this->conn->prepare("UPDATE users SET full_name = ?, email = ? WHERE user_id = ?");
            $updateUserInfoQuery->execute([$fullname, $email, $user_id]);
        } catch (PDOException $e) {
            error_log("error getting user" . $e->getMessage());
        }
    }

    public function getUserById($user_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error in get user by id: " . $e->getMessage();
        }
    }

    public function deleteAccountUser($user_id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);
        } catch (PDOException $e) {
            echo "Error in delete accout user: " . $e->getMessage();
        }
    }
}
