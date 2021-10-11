<?php 

session_start();
require("../includes/config.php");
require("../includes/messages.class.php");
require("../includes/general.functions.php");
if(!checkLogin())
    exit('you are not allowed to view this page');


$gbObj = new messages();

$messages = $gbObj->getMessages("ORDER BY `id` DESC");

include('../templates/admin/header.html');
include('../templates/admin/menu.html');
include('../templates/admin/all-messages.html');
include('../templates/admin/footer.html');

?>