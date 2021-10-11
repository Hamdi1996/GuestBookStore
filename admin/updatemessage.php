<?php 
session_start();
require("../includes/config.php");
require("../includes/messages.class.php");
require("../includes/general.functions.php");
if(!checkLogin())
    exit('you are not allowed to view this page');

    $error = '';
    $success = '';


    $gbObj = new messages();
    $idFromURL = (isset($_GET['id']))? (int) $_GET['id']:0;

include('../templates/admin/header.html');
 include('../templates/admin/menu.html');
    
if(count($_POST)>0){

    $idFromForm    = $_POST['id'];
    $title         = $_POST['title'];
    $content       = $_POST['content'];
    if($gbObj->updateMessage($idFromForm,$title,$content)){
        $success ='Message Updated Successfully';
    }
    else{
        $error = "Message Not Updated";
    }
    include('../templates/admin/message.html');
    include('../templates/admin/footer.html');
    exit;
}
else{
        $message = $gbObj->getMessage($idFromURL);
        if(!$message || count($message)==0){

            $error ="Messsage Not Found";
            include('../templates/admin/message.html');
             include('../templates/admin/footer.html');
             exit;
        }



}
 include('../templates/admin/updatemessage.html');
 include('../templates/admin/footer.html');

?>