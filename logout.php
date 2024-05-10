<?php
    session_start();
    unset($_SESSION["username"]);
    echo "<script>location.replace('dashboard.php');</script>";
?>