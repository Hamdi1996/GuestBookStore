<?php 
session_start();
require("../includes/config.php");
require("../includes/users.class.php");
require("../includes/general.functions.php");

if(!checkLogin()){
    exit("You are not allowed to view this page");
}

/**
 * Carry Error and sucess in varialbe
 */
$errors = array();
$sucess = '';
$usersObj = new users();
if($_SERVER['REQUEST_METHOD'] == "POST"){
   
    $username = CleanInputs($_POST['username']);
    $password = CleanInputs($_POST['password']);
    $email    = CleanInputs($_POST['email']);

       # Validate ... 
       if(!validate($username,1)){
        $errors['username'] = "Requierd Field";
      }elseif(!validate($username,2)){
          $errors['username'] = "Invalid String";
        }

       if(!validate($email,1)){
        $errors['email'] = "Requierd Field";
      }elseif(!validate($email,3)){
          $errors['email'] = "Invalid Email";
        }
        
       if(!validate($password,1)){
        $errors['password'] = "Requierd Field";
      }elseif(!validate($password,5)){
          $errors['password'] = "Password Must be more than 6 ch";
        }

        if(count($errors)==0){
           
                $adduser = $usersObj->addUser($username,$password,$email);
                if($adduser){
                    $sucess = "User Added Successfuly";
                }
                else{
                    $errors ="Invalid Data Submited";
                }
            
        }
   
}





include('../templates/admin/header.html');
 include('../templates/admin/menu.html');
 include('../templates/admin/add-user.html');
 include('../templates/admin/footer.html');

