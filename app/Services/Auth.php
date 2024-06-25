<?php

namespace app\Services;

use model\Users;
use utils\Util;

class Auth
{

    public static $user;
    public static $isLoggedIn;

    public static function isLoggedOut(): bool
    {
        if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
            Util::redirect('login');
        }
        return true;
    }
    public static function isLoggedIn()
    {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            Util::redirect('index');
        }
        return false;
    }
    public static function setCurrentUser(array $row)
    {
        if (!is_array($row)) {
            return false;
        }
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['phone_number'] = $row['phone_number'];
        $_SESSION['file_path'] = $row['file_path'];

    }

    public static function getCurrentUserInfo()
    {
        return array(
            'first_name' => $_SESSION['first_name'] ?? '',
            'last_name' => $_SESSION['last_name'] ?? '',
            'phone_number' => $_SESSION['phone_number'] ?? '',
            'username' => $_SESSION['username'] ?? '',
            'file_path' => $_SESSION['file_path'] ?? ''
        );
    }

    public static function getUsername()
    {
        $userDetails = self::getCurrentUserInfo();
        return $userDetails['username'];

    }

    public static function user() : Users{
        $user = new Users();
        $row = [
            'id' => $_SESSION['user_id'] ?? '',
            'first_name' => $_SESSION['first_name'] ?? '',
            'last_name' => $_SESSION['last_name'] ?? '',
            'phone_number' => $_SESSION['phone_number'] ?? '',
            'username' => $_SESSION['username'] ?? '',
        ];
        $user->loadUser($row);
     return $user;
    }

}

