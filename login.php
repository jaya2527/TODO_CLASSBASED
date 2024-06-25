<?php
require_once 'auto_loader.php';
session_start();
use model\Users;
use app\Services\Auth;
use app\Services\Validator;


Auth::isLoggedIn();
$validator = new Validator($_POST,"Login");
if (isset($_POST['submit']) && $_POST['submit'] == "Login" ){
    $validator->validate();
    if (empty($validator->getErrors())) {
       $errors= Users::loginUser($_POST['username'], $_POST['password']);
        if(!empty($errors)){
          $validator->setErrors($errors);
        }
        else {
            header('location:/index.php');
            exit;
        }
    }
}
include_once "resources/view/login.php";








