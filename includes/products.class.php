<?php 
class products{
    private $connection;
    /**
     * Create Connection
     */
    public function __construct(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function addProduct($title,$description,$image,$price,$status,$user_id)
    {
        # code...
                # code...
         $this->connection->query("INSERT INTO `products`(`title`, `description`, `image`, `price`, `status`, `user_id`)
                                    VALUES('$title','$description','$image',$price,'$status','$user_id')");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }

    }
    /**
     * 
     * Update Product
     */

    public function updateProduct($id,$title,$description,$image,$price,$status)
    {
        # code...
        $this->connection->query("UPDATE `products` SET `title`='$title', `description`='$description', `image`='$image',
                                 `price`=$price, `status`='$status' WHERE `id`=$id");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }
    
    }

    /**
     * 
     * Delete Product
     */
    public function deleteProduct($id)
    {
        # code...
        
        $this->connection->query("DELETE FROM `products` WHERE `id`=$id");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * 
     * 
     * Get Products
     */
    public function getProducts($extra='')
    {
        # code...
        $result = $this->connection->query("SELECT * FROM `products` $extra");
        if($result->num_rows>0){
            $products = array();
            while ($row = $result->fetch_assoc()) {
                # code...
                $products[]=$row;
            }
            return $products;
        }
        else{
            return null;
        }

    }
    /**
     * 
     * Get Product one
     */
    public function getProduct($id)
    {
        # code...
        $product = $this->getProducts("WHERE `id`=$id");
        if($product && count($product)>0){
         return $product[0];
        }
        else {
        return null; 
        } 
    }

    /**
     * 
     * Search For Product
     */
    public function searchProduct($keyword)
    {
        # code...
        return $this->getProducts("WHERE `title` LIKE '%$keyword%'");

    }
   

    /***
     * 
     * Close Connection 
     */
    public function __destruct(){
        $this->connection->close();
    }




}