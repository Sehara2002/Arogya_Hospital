<?php
require "./DB/database.php";
$db = new database();
$con = $db->get_con();
session_start();
if(isset($_SESSION["username"])){
    $sql = "SELECT cf_name FROM client_users WHERE c_un='".$_SESSION["username"]."'";
    $result = $con->query($sql);
    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            $_SESSION["Fname"] = $row["cf_name"];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./CSS/Navbar.css">
    <link rel="stylesheet" href="./CSS/dashboard.css">
    <title>Arogya Hospital</title>
</head>

<body>
    <nav>
        <div class="container-fluid nav-container">
            <div class="row">
                <div class="col-sm-3">
                    <a href="index.php" class="logo">
                        Arogya Hospital
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="container navbar">
                        <ul class="nav-bar">
                            <li class="nav-item"><a href="" class="nav-link">My Portal</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Appointments</a></li>
                            <li class="nav-item"><a href="" class="nav-link">History</a></li>
                            <li class="nav-item"><a href="" class="nav-link">Help</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 user text-center">
                    <div class="user">
                    <p class="username">
                        <?php echo $_SESSION["Fname"]?>
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="container banner-section">
                    <div class="main-title">
                        <p class="topic">Welcome to Arogya Hospital</p>
                        <p class="theme-text">Your health is our wealth</p>
                        <div class="button-section text-center">
                        <a href="./appointment.php" class="btn btn-primary text-center btn1">Make Appointment</a>
                        <a href="./contact.php" class="btn btn-primary text-center btn2">Contact Us</a>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </main>
</body>

</html>