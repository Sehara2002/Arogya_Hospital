<?php
require "database.php";

if(isset($_GET["a_id"])){
    $new_appointment = new appointments();
    $new_appointment->a_no = $_GET["a_id"];
    $result = $new_appointment->cancelAppointments($new_appointment->a_no);
    if($result === true){
        echo "<script>
        alert('Appointment Canceled');
        location.replace('../appointment.php');</script>";
    }else{
        echo "<script>
        alert('Appointment Cannot be Canceled');
        location.replace('../appointment.php');</script>";
    }
}

if(isset($_GET["u_id"])){
    $new_appointment = new appointments();
    $new_appointment->a_no = $_GET["u_id"];
    $new_appointment->findAppointment($new_appointment->a_no);
    
}
class appointments
{
    public $a_no;
    public $c_no;
    public $cf_name;
    public $d_no;
    public $df_name;
    public $a_date;
    public $a_time;
    public $a_description;
    public $a_fee;
    public $a_state;


    function placeAppointments( $c_no, $cf_name, $d_no, $df_name, $a_date, $a_time, $a_description, $a_fee, $a_state)
    {
        $db = new database();
        $con = $db->get_con();
        $sql = "CALL placeAppointment(" . $c_no . ",'" . $cf_name . "'," . $d_no . ",'" . $df_name . "','" . $a_date. "','" . $a_time . "','" . $a_description. "'," . $a_fee . ",'" . $a_state . "');";
        $result = $con->query($sql);

        if ($result->num_rows>0) {
           $row = $result->fetch_assoc();
           return $row['a_no'];
        } else {
            return -1;
        }
    }

    function getAppointments( $c_no, $cf_name, $d_no, $df_name, $a_date, $a_time, $a_description, $a_fee, $a_state)
    {
        $db = new database();
        $con = $db->get_con();
        $sql = "";
        $result = $con->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    function updateAppointments( $c_no, $cf_name, $d_no, $df_name, $a_date, $a_time, $a_description, $a_fee, $a_state)
    {
        $db = new database();
        $con = $db->get_con();
        $sql = "";
        $result = $con->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
    function cancelAppointments($a_no)
    {
        $db = new database();
        $con = $db->get_con();
        $sql = "DELETE FROM appointments WHERE a_no = ".$a_no.";";
        $result = $con->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    function findAppointment($a_no){
        session_start();
        $db = new database();
        $con = $db->get_con();
        $sql = "SELECT * FROM appointments WHERE a_no = ".$a_no.";";
        $result = $con->query($sql);
        if ($result->num_rows>0) {
            while($row=$result->fetch_assoc()){
                $_SESSION["ua_no"] = $row["a_no"];
                $_SESSION["uc_no"] = $row["c_no"];
                $_SESSION["ucf_name"] = $row["cf_name"];
                $_SESSION["ud_no"] = $row["d_no"];
                $_SESSION["udf_name"] = $row["df_name"];
                $_SESSION["ua_date"] = $row["a_no"];
                $_SESSION["ua_state"] = $row["a_state"];
                $_SESSION["ua_desc"] = $row["a_description"];

                echo "<script>location.replace('../appointment.php')</script>";
            }
        }
    }

    
}




