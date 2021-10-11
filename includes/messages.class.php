<?php 

class messages{
    private $connection;
    /**
     * Create Connection
     */
    public function __construct(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }

    public function addMessage($title,$content,$name,$email)
    {
        
         $this->connection->query("INSERT INTO `messages`(`title`, `content`, `name`, `email`)
                                    VALUES('$title','$content','$name','$email')");
        if($this->connection->affected_rows >0){
            return true;
           
        }
        else{ echo $this->connection->error;
            return false;
        }

    }

    public function updateMessage($id,$title,$content)
    {
        # code...
        $this->connection->query("UPDATE `messages` SET (`title`='$title', `content`='$content') WHERE `id`=$id");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }
    
    }

    public function deleteMessage($id)
    {
        # code...
        
        $this->connection->query("DELETE FROM `messages` WHERE `id`=$id");
        if($this->connection->affected_rows >0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getMessages($extra='')
    {
        # code...
        $result = $this->connection->query("SELECT * FROM `messages` $extra");
        if($result->num_rows>0){
            $messages = array();
            while ($row = $result->fetch_assoc()) {
                # code...
                $messages[]=$row;
            }
            return $messages;
        }
        else{
            return null;
        }
    }

        /**
     * 
     * Get Messagen by id
     */
    public function getMessage($id)
    {
        # code...
        $messages = $this->getMessages("WHERE `id`=$id");
        if($messages && count($messages)>0)
         return $messages[0];

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