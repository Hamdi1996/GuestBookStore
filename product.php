<?php 
include ('includes/config.php');
include ('includes/products.class.php');
$selected ='product';

include ('templates/front/header.html');

$id = (isset($_GET['id']))? (int)$_GET['id']:0;
$productObj = new products();
$product = $productObj->getProduct($id);
if($product && count($product)>0){
    include ('templates/front/product-info.html');

}
else 
{
    include ('templates/front/404.html');
}

include ('templates/front/footer.html');

?>