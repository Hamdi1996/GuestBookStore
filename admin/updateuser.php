<?php 
session_start();
require("../includes/config.php");
require("../includes/users.class.php");
require("../includes/general.functions.php");

if(!checkLogin()){
    exit("You are not allowed to view this page");
}

$idFromUrl = (isset($_GET['id']))? (int) $_GET['id']:0;

$usersObj = new users();
$error ='';
$success ='';

if(count($_POST)>0){

    $username      = $_POST['username'];
    $password      = $_POST['password'];
    $email         = $_POST['email'];
    $idFromForm    = $_POST['id'];

    if($usersObj->updateUser($idFromForm,$username,$password,$email)){
        $success ='User Updated';
    }
    else{
        $error = "User Not Updated";
    }
}
else{
    // Get user from DB
    $user =$usersObj->getUser($idFromUrl);
    // Put value in input field


}
include('../templates/admin/header.html');
 include('../templates/admin/menu.html');
 include('../templates/admin/update-user.html');
 include('../templates/admin/footer.html');

?>