<?php 
session_start();
require("../includes/config.php");
require("../includes/users.class.php");
require("../includes/general.functions.php");

if(!checkLogin()){
    exit("You are not allowed to view this page");
}

/***
 * Else Logged in
 */
 $usersObj = new users();
 $allusers = $usersObj->getUsers();

 include('../templates/admin/header.html');
 include('../templates/admin/menu.html');
 include('../templates/admin/all-users.html');
 include('../templates/admin/footer.html');
 ?>