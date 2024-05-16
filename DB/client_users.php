<?php

require './DB/database.php';

class Client_users
{
    public $c_no;
    public $cf_name;
    public $cl_name;
    public $c_age;
    public $c_gender;
    public $c_email;
    public $c_contact;
    public $ce_contact;
    public $c_un;
    public $c_pw;

    
    function create_user($cf_name,$cl_name,$c_age,$c_gender,$c_email,$c_contact,$ce_contact,$c_un,$c_pw){
        $db = new database();
        $con=$db->get_con();
        $sql = "CALL addClient('".$cf_name."','".$cl_name."',".$c_age.",'".$c_gender."','".$c_email."','".$c_contact."','".$ce_contact."','".$c_un."','".$c_pw."');";
        $result = $con->query($sql);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }


    

    function logoutuser(){
        session_destroy();
        echo "<script></script>";
    }
}

