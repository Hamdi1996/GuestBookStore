<?php 
session_start();
require("../includes/config.php");
require("../includes/products.class.php");
require("../includes/general.functions.php");

if(!checkLogin()){
    exit("You are not allowed to view this page");
}

/**
 * Carry Error and sucess in varialbe
 */
$errors = [];
$success = '';

if(count($_POST)>0){
    $productsObj   = new products();
    $title         = CleanInputs($_POST['title']);
    $description   = CleanInputs($_POST['description']);
    $price         = CleanInputs($_POST['price']);
    $available     = CleanInputs($_POST['available']);
    $userId        = CleanInputs($_SESSION['user']['id']);
    $image='';
    // Validate Input
    if(!validate($title,1)){
        $errors['title'] = "Requierd Field";
      }elseif(!validate($title,2)){
          $errors['title'] = "Invalid String";
        }

       if(!validate($description,1)){
        $errors['description'] = "Requierd Field";
      }elseif(!validate($description,2)){
          $errors['description'] = "Invalid String";
        }
        
       if(!validate($price,1)){
        $errors['price'] = "Requierd Field";
      }elseif(!validate($price,6)){
          $errors['price'] = "InValid Number";
        }

    if(isset($_FILES['image'])){
        //
        $name   = $_FILES['image']['name'];
        $type   = $_FILES['image']['type'];
        $temp   = $_FILES['image']['tmp_name'];
        $error  = $_FILES['image']['error'];
        $size   = $_FILES['image']['size'];

        if($type =='image/png' || $type=='image/jpeg'||$type=='image/jpg' && $error ==0){
            $image = md5($name.date('U').rand(1000,100000)).$name;
           move_uploaded_file($temp,'../uploads/'.$image);
        }
        
    }


    if(count($errors)==0){

    $addproduct = $productsObj->addProduct($title,$description,$image,$price,$status,$userId);
    if($addproduct){
        $success = "Product Added Successfuly";
    }
    else{
        $errors ="Invalid Product Submited";
    }
}
}



include('../templates/admin/header.html');
 include('../templates/admin/menu.html');
 include('../templates/admin/add-product.html');
 include('../templates/admin/footer.html');
