
<?php
session_start();
require_once 'auto_loader.php';
include './app/DbConnect/Db.php';

use utils\Util;
use model\Users;
use app\Services\Validator;



$validator = new Validator($_POST, "Register", $_FILES);
if (isset($_POST['submit']) && $_POST['submit'] == "Register") {
    $validator->validate();
    if (empty($validator->getErrors())) {


        $upload_response = Util::upload($_FILES['file']);
        if (!$upload_response['error']) {

            $registerUserData = [
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'username' => $_POST['username'] ?? '',
                'password' => $_POST['password'] ?? '',
                'file' => $upload_response['path'] ?? '',
            ];
            Users::insert($registerUserData);
        }
    }
}
include_once "resources/view/registration.php";



