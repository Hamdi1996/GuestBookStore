<?php 
class users{
    private $connection;
    /**
     * Create Connection
     */
    public function __construct(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }
    public function addUser($username,$password,$email)
    {
        # code...
        $password =md5($password);
         $this->connection->query("INSERT INTO `users`(`username`, `password`, `email`) VALUES('$username','$password','$email')");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }

    }
    public function updateUser($id,$username,$password,$email)
    {
        # code...
        $sqlOP = "UPDATE `users` SET ";
        if(strlen($username)>0){
            $sqlOP .= "`username`='$username'";
        }
        
        if(strlen($password)>0){
            $password =md5($password);
            $sqlOP .= ",`password`='$password'";
        }
        if(strlen($email)>0){
            $sqlOP .= ",`email`='$email'";
        }

        $sqlOP .= "WHERE `id`=$id";

        $this->connection->query($sqlOP);
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteUser($id)
    {
        # code...

        $this->connection->query("DELETE FROM `users` WHERE `id`=$id");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }

    }
    /***
     * Get All users
     */
    public function getUsers($extra ='')
    {
        # code...
        $result = $this->connection->query("SELECT * FROM `users` $extra");
        if($result->num_rows>0){
            $users = array();
            while ($row = $result->fetch_assoc()) {
                # code...
                $users[]=$row;
            }
            return $users;
        }
        else{
            return null;
        }


    }
    /***
     * Get user by id
     */
    public function getUser($id)
    {
        # code...
        $users = $this->getUsers("WHERE `id`=$id");
        if($users && count($users)>0)
         return $users[0];

        return null; 
        

    }

    /***
     * using Function Of Get user and check login for username and  Password
     */
    public function login($username,$password)
    {
        # code...
        $users =$this->getUsers("WHERE `username`='$username' AND `password`='$password'");
        if($users && count($users)>0)
         return $users[0];

        return null; 
        
    }

    /***
     * 
     * Close Connection 
     */
    public function __destruct(){
        $this->connection->close();
    }
} 



?>