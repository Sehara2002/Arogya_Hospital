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
        $sql = "INSERT INTO client_users(cf_name,cl_name,c_age,c_gender,c_email,c_contact,ce_contact,c_un,c_pw) VALUES('".$cf_name."','".$cl_name."',".$c_age.",'".$c_gender."','".$c_email."','".$c_contact."','".$ce_contact."','".$c_un."','".$c_pw."');";
        $result = $con->query($sql);
        if($result === true){
            return true;
        }else{
            return false;
        }
    }

    function login($username,$password){
        $db = new database();
        $con = $db->get_con();
        $sql = "SELECT c_un,c_pw FROM client_users WHERE c_un = '".$username."';";
        $result = $con->query($sql);
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $db_un = $row["c_un"];
                $db_pw = $row["c_pw"];
                if(($db_un == $username) && ($db_pw == $password)){
                    return true;
                }else{
                    echo "<script>console.log('Username or Password Incorrect');</script>";
                    return false;
                }
            }
        }else{
            echo "<script>console.log('Cannot find the record');</script>";
            return false;
        }

    }
}
