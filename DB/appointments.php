<?php
require "./DB/database.php";
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
        $sql = "INSERT INTO appointments(c_no,cf_name,d_no,df_name,a_date,a_time,a_description,a_fee,a_state) VALUES(" . $c_no . ",'" . $cf_name . "'," . $d_no . ",'" . $df_name . "','" . $a_date. "','" . $a_time . "','" . $a_description. "'," . $a_fee . ",'" . $a_state . "');";
        $result = $con->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
}



