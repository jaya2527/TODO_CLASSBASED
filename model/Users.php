<?php

namespace model;

use app\DbConnect\Db;
use PDO;
use PDOException;
use utils\Util;
use app\Services\Auth;


//session_start();

class Users
{

    public $id;
    public $first_name;
    public $last_name;
    public $username;


    public function loadUser($user)
    {
        $this->id = $user['id'];
        $this->first_name = $user['first_name'];
        $this->last_name = $user['last_name'];
        $this->username = $user['username'];
    }


    public static function insert($registerUserData)
    {
        try {
            $first_name = $registerUserData['first_name'];
            $last_name = $registerUserData['last_name'];
            $phone_number = $registerUserData['phone_number'];
            $username = $registerUserData['username'];
            $password = password_hash($registerUserData['password'], PASSWORD_DEFAULT);
            $path = $registerUserData['file'] ?? '';

            $connect = Db::connect();

            $stmt = $connect->prepare("INSERT INTO users (first_name, last_name, phone_number, username, password, file_path) VALUES (:first_name, :last_name, :phone_number, :username, :password, :file_path)");
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':phone_number', $phone_number);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':file_path', $path);

            if ($stmt->execute()) {
                $_SESSION['Registered'] = true;
                Util::redirect('login');
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Error:" . $errorInfo[2];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public static function loginUser($username, $password)
    {
        $connect = Db::connect();
        $stmt = $connect->prepare("select * from users where username=:username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $errors = [];

        if ($row) {
            if (password_verify($password, $row['password'])) {
                Auth::setCurrentUser($row);
            } else {
                $errors['password'] = 'Password is wrong';
            }
        } else {
            $errors['username'] = 'User does not exist';

        }
        return $errors;
    }

}


