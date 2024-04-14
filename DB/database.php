<?php

class database{
    public $host = "localhost";
    public $username = "root";
    public $password = "Shehara2002@#";
    public $database = "arogya_hospital";
    
    function get_con(){
        $con = new mysqli($this->host,$this->username,$this->password,$this->database);
        if($con->connect_error === true){
            die("Connection failed".$con->connect_error);
        }else{
            echo "<script>console.log('Connection Success');</script>";
            return $con;
        }
    }
}




?>