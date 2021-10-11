<?php 
include ('includes/config.php');
include ('includes/messages.class.php');
require("includes/general.functions.php");

$selected ='gb';


$success = '';
$errors = [];
$gbObj = new messages();
if($_SERVER['REQUEST_METHOD'] == "POST"){


    $title    = $_POST['title'];
    $content  = $_POST['content'];
    $name     = $_POST['name'];
    $email    = $_POST['email'];

       # Validate ... 
       if(!validate($title,1)){
        $errors['Title'] = "Requierd Field";
      }elseif(!validate($title,2)){
          $errors['Title'] = "Invalid String";
        }
       if(!validate($content,1)){
        $errors['content'] = "Requierd Field";
      }elseif(!validate($content,2)){
          $errors['content'] = "Invalid String";
        }
       if(!validate($name,1)){
        $errors['name'] = "Requierd Field";
      }elseif(!validate($name,2)){
          $errors['name'] = "Invalid String";
        }
  
        if(!validate($email,1)){
            $errors['email'] = "Requierd Field";
          }elseif(!validate($email,3)){
              $errors['email'] = "Invalid Email";
            }
            
            if(count($errors)==0){
        if($gbObj->addMessage($title,$content,$name,$email)){
        $success = "Message Added Successfuly";
     }
    $messages = $gbObj->getMessages('ORDER BY `id` DESC');
}
    
}

else{
    $messages = $gbObj->getMessages('ORDER BY `id` DESC');
}
include ('templates/front/header.html');
include ('templates/front/guestbook.html');
include ('templates/front/footer.html');
?>