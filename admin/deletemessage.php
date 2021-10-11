<?php 
session_start();
require("../includes/config.php");
require("../includes/messages.class.php");
require("../includes/general.functions.php");
if(!checkLogin())
    exit('you are not allowed to view this page');

 
$id = (isset($_GET['id']))? (int) $_GET['id']:0;
$error = '';
$success = '';

$gbObj = new messages();
include('../templates/admin/header.html');
include('../templates/admin/menu.html');

if($gbObj->deleteMessage($id)){
    $success ="Message Deleted Successfully";
}
else
{
    $error ="Messqge Not Delted";
}




include('../templates/admin/message.html');

include('../templates/admin/footer.html');