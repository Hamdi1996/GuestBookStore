<?php 
session_start();
require("../includes/config.php");
require("../includes/users.class.php");
require("../includes/general.functions.php");

if(!checkLogin()){
    exit("You are not allowed to view this page");
}

$id = (isset($_GET['id']))? (int) $_GET['id']:0;

$usersObj = new users();
if($usersObj->deleteUser($id)){
    header("Location: users.php");
}
else 
{
    echo "Invalid User Selected";
}


?>