<?php 
session_start();
require('../includes/config.php');
require('../includes/general.functions.php');
require('../includes/users.class.php');

if(checkLogin()){
    exit("You are already logged in");
}

$errors='';
$sucess='';

if(count($_POST)>0){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userObj  = new users();
    $userData = $userObj->login($username,$password);
    if($userData && count($userData)>0){
    $_SESSION['user']=$userData;
    $sucess = "You are logged succesfully";
}
else{

    $errors="Invalid username or password";
} 
}

include('../templates/admin/login.html');
?>